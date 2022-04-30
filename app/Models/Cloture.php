<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cloture
 * 
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class Cloture extends Model
{
	protected $table = 'clotures';
	public $incrementing = false;
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
