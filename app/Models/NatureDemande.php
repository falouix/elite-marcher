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
 * Class NatureDemande
 *
 * @property int $id
 * @property string $libelle
 * @property int $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class NatureDemande extends Model
{
	use SoftDeletes;
	protected $table = 'nature_demandes';

	protected $casts = [
		'type' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'type',
		'created_by',
		'updated_by'
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
        return $this->hasMany('App\Models\LignesBesoin', 'nature_demandes_id');
    }

}
