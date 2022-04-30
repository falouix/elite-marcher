<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enregistrement
 * 
 * @property int $id
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class Enregistrement extends Model
{
	protected $table = 'enregistrements';
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
