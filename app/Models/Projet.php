<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Projet
 *
 * @property int $id
 * @property string|null $code_pa
 * @property Carbon|null $date_projet
 * @property string|null $annee_gestion
 * @property string|null $objet
 * @property Carbon|null $date_action_prevu
 * @property string|null $type_demande
 * @property string|null $nature_passation
 * @property int|null $services_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Collection|LignesProjet[] $lignes_projets
 *
 * @package App\Models
 */
class Projet extends Model
{
	use SoftDeletes;
	protected $table = 'projets';

	protected $casts = [
		'services_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_projet',
		'date_action_prevu'
	];

	protected $fillable = [
		'code_pa',
		'date_projet',
        'annee_gestion',
		'objet',
		'date_action_prevu',
		'type_demande',
		'nature_passation',
		'services_id',
		'created_by',
		'updated_by'
	];
    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->date_projet =Carbon::now()->format('Y-m-d');
        });
        static::created(function ($model) {
            $count = \DB::table('projets')
            ->select(\DB::raw('count(*) as count'))
            ->count();
            $model->code_pa = 'PA'.str_pad($count.'/'. date('Y'), 10, '0', STR_PAD_LEFT);
            $model->save();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }
    public function service()
	{
		return $this->belongsTo(Service::class, 'services_id');
	}

	public function lignes_projets()
	{
		return $this->hasMany(LignesProjet::class, 'projets_id');
	}
    public function getCreatedAtAttribute()
    {
        return (new Carbon($this->attributes['created_at']))->format('Y-m-d');
    }
    public function getDateActionPrevuAttribute()
    {
        return (new Carbon($this->attributes['date_action_prevu']))->format('Y-m-d');
    }
}
