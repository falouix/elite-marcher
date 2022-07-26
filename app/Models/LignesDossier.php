<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LignesDossier
 *
 * @property int $id
 * @property int|null $num_lot
 * @property string|null $libelle
 * @property int $lignes_projet_id
 * @property int|null $qte
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int $dossiers_achats_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class LignesDossier extends Model
{
	use SoftDeletes;
	protected $table = 'lignes_dossiers';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'num_lot' => 'int',
		'lignes_projet_id' => 'int',
		'qte' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'num_lot',
		'libelle',
		'lignes_projet_id',
		'qte',
		'cout_unite_ttc',
		'cout_total_ttc',
		'dossiers_achats_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
