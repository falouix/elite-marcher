<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cloture
 * 
 * @property Carbon|null $date_cloure
 * @property float|null $montant_origin
 * @property float|null $montant_final
 * @property int|null $duree_travaux_prv
 * @property int|null $duree_travaux_reel
 * @property int|null $duree_pause_travaux
 * @property float|null $taux_penanlite
 * @property float|null $montant_penalite
 * @property int $dossiers_achats_id
 * @property int|null $soumissionnaires_id
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
class Cloture extends Model
{
	use SoftDeletes;
	protected $table = 'clotures';
	public $incrementing = false;

	protected $casts = [
		'montant_origin' => 'float',
		'montant_final' => 'float',
		'duree_travaux_prv' => 'int',
		'duree_travaux_reel' => 'int',
		'duree_pause_travaux' => 'int',
		'taux_penanlite' => 'float',
		'montant_penalite' => 'float',
		'dossiers_achats_id' => 'int',
		'soumissionnaires_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_cloure'
	];

	protected $fillable = [
		'date_cloure',
		'montant_origin',
		'montant_final',
		'duree_travaux_prv',
		'duree_travaux_reel',
		'duree_pause_travaux',
		'taux_penanlite',
		'montant_penalite',
		'dossiers_achats_id',
		'soumissionnaires_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
