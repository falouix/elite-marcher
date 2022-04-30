<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceOrdre
 * 
 * @property int $id
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class ServiceOrdre extends Model
{
	protected $table = 'service_ordres';
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
}
