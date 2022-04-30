<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LignesBesoin
 * 
 * @property int $id
 * @property string|null $libelle
 * @property int|null $qte_demande
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int|null $qte_valide
 * @property int $besoins_id
 * @property int|null $projets_id
 * 
 * @property Besoin $besoin
 *
 * @package App\Models
 */
class LignesBesoin extends Model
{
	protected $table = 'lignes_besoins';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'qte_demande' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'qte_valide' => 'int',
		'besoins_id' => 'int',
		'projets_id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'qte_demande',
		'cout_unite_ttc',
		'cout_total_ttc',
		'qte_valide',
		'besoins_id',
		'projets_id'
	];

	public function besoin()
	{
		return $this->belongsTo(Besoin::class, 'besoins_id');
	}
}
