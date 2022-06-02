<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AvisDossier
 * 
 * @property int $id
 * @property Carbon|null $date_avis
 * @property string|null $destination
 * @property int|null $duree_avis
 * @property Carbon|null $date_debut_avis
 * @property Carbon|null $date_validite
 * @property Carbon|null $date_ouverture_plis
 * @property string|null $ref_avis
 * @property string|null $texte_avis
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
class AvisDossier extends Model
{
	use SoftDeletes;
	protected $table = 'avis_dossiers';

	protected $casts = [
		'duree_avis' => 'int',
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_avis',
		'date_debut_avis',
		'date_validite',
		'date_ouverture_plis'
	];

	protected $fillable = [
		'date_avis',
		'destination',
		'duree_avis',
		'date_debut_avis',
		'date_validite',
		'date_ouverture_plis',
		'ref_avis',
		'texte_avis',
		'dossiers_achats_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
