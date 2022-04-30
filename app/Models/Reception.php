<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reception
 * 
 * @property int $id
 * @property int|null $type_reception
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class Reception extends Model
{
	protected $table = 'receptions';
	public $timestamps = false;

	protected $casts = [
		'type_reception' => 'int',
		'dossiers_achats_id' => 'int'
	];

	protected $fillable = [
		'type_reception',
		'dossiers_achats_id'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
