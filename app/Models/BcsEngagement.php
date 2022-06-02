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
 * Class BcsEngagement
 * 
 * @property int $id
 * @property int $dossiers_achats_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property DossiersAchat $dossiers_achat
 * @property Collection|LigneBc[] $ligne_bcs
 *
 * @package App\Models
 */
class BcsEngagement extends Model
{
	use SoftDeletes;
	protected $table = 'bcs_engagements';

	protected $casts = [
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'dossiers_achats_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}

	public function ligne_bcs()
	{
		return $this->hasMany(LigneBc::class, 'bcs_engagements_id');
	}
}
