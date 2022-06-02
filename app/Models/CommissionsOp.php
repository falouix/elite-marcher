<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property DossiersAchat $dossiers_achat
 * @property Collection|Offre[] $offres
 *
 * @package App\Models
 */
class CommissionsOp extends Model
{
	use SoftDeletes;
	protected $table = 'commissions_ops';

	protected $casts = [
		'type_session' => 'int',
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
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
		'path_pv',
		'created_by',
		'updated_by'
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
