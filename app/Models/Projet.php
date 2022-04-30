<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Projet
 * 
 * @property int $id
 * @property string|null $code_pa
 * @property Carbon|null $date_projet
 * @property string|null $objet
 * @property Carbon|null $date_action_prevu
 * @property string|null $type_demande
 * @property string|null $nature_passation
 * @property int|null $services_id
 * 
 * @property Collection|LignesProjet[] $lignes_projets
 *
 * @package App\Models
 */
class Projet extends Model
{
	protected $table = 'projets';
	public $timestamps = false;

	protected $casts = [
		'services_id' => 'int'
	];

	protected $dates = [
		'date_projet',
		'date_action_prevu'
	];

	protected $fillable = [
		'code_pa',
		'date_projet',
		'objet',
		'date_action_prevu',
		'type_demande',
		'nature_passation',
		'services_id'
	];

	public function lignes_projets()
	{
		return $this->hasMany(LignesProjet::class, 'projets_id');
	}
}
