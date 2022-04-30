<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Offre
 * 
 * @property int $id
 * @property string|null $ref_offre
 * @property int|null $source_offre
 * @property Carbon|null $date_arrive
 * @property Carbon|null $date_enregistrement
 * @property string|null $ref_bo
 * @property string|null $observation
 * @property int $dossiers_achats_id
 * @property int|null $soumissionaire_id
 * @property int|null $nbr_lots
 * @property float|null $prix_offre
 * @property string|null $decision_op
 * @property string|null $observations
 * @property int $commissions_ops_id
 * @property string|null $decision_technique
 * @property int $commissions_techniques_id
 * 
 * @property CommissionsOp $commissions_op
 * @property CommissionsTechnique $commissions_technique
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class Offre extends Model
{
	protected $table = 'offres';
	public $timestamps = false;

	protected $casts = [
		'source_offre' => 'int',
		'dossiers_achats_id' => 'int',
		'soumissionaire_id' => 'int',
		'nbr_lots' => 'int',
		'prix_offre' => 'float',
		'commissions_ops_id' => 'int',
		'commissions_techniques_id' => 'int'
	];

	protected $dates = [
		'date_arrive',
		'date_enregistrement'
	];

	protected $fillable = [
		'ref_offre',
		'source_offre',
		'date_arrive',
		'date_enregistrement',
		'ref_bo',
		'observation',
		'dossiers_achats_id',
		'soumissionaire_id',
		'nbr_lots',
		'prix_offre',
		'decision_op',
		'observations',
		'commissions_ops_id',
		'decision_technique',
		'commissions_techniques_id'
	];

	public function commissions_op()
	{
		return $this->belongsTo(CommissionsOp::class, 'commissions_ops_id');
	}

	public function commissions_technique()
	{
		return $this->belongsTo(CommissionsTechnique::class, 'commissions_techniques_id');
	}

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
