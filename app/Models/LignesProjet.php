<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LignesProjet
 * 
 * @property int $id
 * @property int|null $num_lot
 * @property int|null $libelle
 * @property int|null $qte
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int $projets_id
 * 
 * @property Projet $projet
 *
 * @package App\Models
 */
class LignesProjet extends Model
{
	protected $table = 'lignes_projets';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'num_lot' => 'int',
		'libelle' => 'int',
		'qte' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'projets_id' => 'int'
	];

	protected $fillable = [
		'num_lot',
		'libelle',
		'qte',
		'cout_unite_ttc',
		'cout_total_ttc',
		'projets_id'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}
}
