<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BesoinsParam
 *
 * @property int $id
 * @property string $annee_gestion
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class BesoinsParam extends Model
{
	use SoftDeletes;
	protected $table = 'besoins_params';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'annee_gestion',
		'date_debut',
		'date_fin',
		'created_by',
		'updated_by'
	];
    public function getDateDebutAttribute()
    {
        return strftime('%Y-%m-%d %H:%M', strtotime($this->attributes['date_debut']));
       // return (new Carbon($this->attributes['date_debut']))->format('Y/m/d H:i');
    }
    public function getDateFinAttribute()
    {
        return strftime('%Y-%m-%d %H:%M', strtotime($this->attributes['date_fin']));
       // return (new Carbon($this->attributes['date_fin']))->format('Y/m/d H:i');
    }
}
