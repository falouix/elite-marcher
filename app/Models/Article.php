<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 *
 * @property int $id
 * @property string $libelle
 * @property bool|null $valider
 * @property Carbon|null $date_validation
 * @property int $natures_demande_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $validated_by
 *
 * @package App\Models
 */
class Article extends Model
{
	use SoftDeletes;
	protected $table = 'articles';

	protected $casts = [
		'valider' => 'bool',
		'natures_demande_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'validated_by' => 'int'
	];

	protected $dates = [
		'date_validation'
	];

	protected $fillable = [
		'libelle',
		'valider',
		'date_validation',
		'natures_demande_id',
		'created_by',
		'updated_by',
		'validated_by'
	];
    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });

        static::deleting(function ($client) {
            //$relationMethods = ['cases', 'clientOffers', 'consultations', 'poas', 'prosecutions'];
            $relationMethods = ['LignesBesoin'];

            foreach ($relationMethods as $relationMethod) {
                if ($client->$relationMethod()->count() > 0) {
                    session()->flash('delete_error', "You can't delete a workorder that has a Continuation");
                    return false;
                    break;
                }
            }
        });
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function LignesBesoin()
    {
        return $this->hasMany('App\Models\LignesBesoin', 'articles_id');
    }

}
