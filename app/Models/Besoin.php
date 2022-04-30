<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoin
 * 
 * @property int $id
 * @property string|null $annee_gestion
 * @property Carbon|null $date_besoin
 * @property bool|null $valider
 * @property Carbon|null $date_validation
 * @property int $services_id
 * 
 * @property Service $service
 * @property Collection|LignesBesoin[] $lignes_besoins
 *
 * @package App\Models
 */
class Besoin extends Model
{
	protected $table = 'besoins';
	public $timestamps = false;

	protected $casts = [
		'valider' => 'bool',
		'services_id' => 'int'
	];

	protected $dates = [
		'date_besoin',
		'date_validation'
	];

	protected $fillable = [
		'annee_gestion',
		'date_besoin',
		'valider',
		'date_validation',
		'services_id'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'services_id');
	}

	public function lignes_besoins()
	{
		return $this->hasMany(LignesBesoin::class, 'besoins_id');
	}
}
