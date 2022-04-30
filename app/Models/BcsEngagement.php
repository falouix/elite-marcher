<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BcsEngagement
 * 
 * @property int $id
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 * @property Collection|LigneBc[] $ligne_bcs
 *
 * @package App\Models
 */
class BcsEngagement extends Model
{
	protected $table = 'bcs_engagements';
	public $timestamps = false;

	protected $casts = [
		'dossiers_achats_id' => 'int'
	];

	protected $fillable = [
		'dossiers_achats_id'
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
