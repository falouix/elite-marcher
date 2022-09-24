<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class Service
 *
 * @property int $id
 * @property string|null $libelle
 * @property string|null $contact
 * @property string|null $responsable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Collection|Besoin[] $besoins
 *
 * @package App\Models
 */
class Service extends Model
{
	//use SoftDeletes;
	protected $table = 'services';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'contact',
		'responsable',
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
           // $relationMethods = ['besoins', 'clientOffers', 'consultations', 'poas', 'prosecutions'];
            $relationMethods = ['besoins'];

            foreach ($relationMethods as $relationMethod) {
                if ($client->$relationMethod()->count() > 0) {
                    session()->flash('delete_error', "You can't delete a workorder that has a Continuation");
                    return false;
                    break;
                }
            }
        });
    }

	public function besoins()
	{
		return $this->hasMany(Besoin::class, 'services_id');
	}
}
