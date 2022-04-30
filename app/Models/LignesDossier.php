<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LignesDossier
 * 
 * @property int $id
 * @property int|null $num_lot
 * @property int|null $libelle
 * @property int|null $qte
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class LignesDossier extends Model
{
	protected $table = 'lignes_dossiers';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'num_lot' => 'int',
		'libelle' => 'int',
		'qte' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'dossiers_achats_id' => 'int'
	];

	protected $fillable = [
		'num_lot',
		'libelle',
		'qte',
		'cout_unite_ttc',
		'cout_total_ttc',
		'dossiers_achats_id'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
