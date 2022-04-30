<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommissionsOp
 * 
 * @property int $id
 * @property string|null $num_session
 * @property int|null $type_session
 * @property Carbon|null $date_session
 * @property string|null $agent_ids
 * @property int $dossiers_achats_id
 * @property string|null $libelle_pv
 * @property string|null $path_pv
 * 
 * @property DossiersAchat $dossiers_achat
 * @property Collection|Offre[] $offres
 *
 * @package App\Models
 */
class CommissionsOp extends Model
{
	protected $table = 'commissions_ops';
	public $timestamps = false;

	protected $casts = [
		'type_session' => 'int',
		'dossiers_achats_id' => 'int'
	];

	protected $dates = [
		'date_session'
	];

	protected $fillable = [
		'num_session',
		'type_session',
		'date_session',
		'agent_ids',
		'dossiers_achats_id',
		'libelle_pv',
		'path_pv'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}

	public function offres()
	{
		return $this->hasMany(Offre::class, 'commissions_ops_id');
	}
}
