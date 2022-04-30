<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DossierDoc
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $path
 * @property int $dossiers_achats_id
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class DossierDoc extends Model
{
	protected $table = 'dossier_docs';
	public $timestamps = false;

	protected $casts = [
		'dossiers_achats_id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'path',
		'dossiers_achats_id'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
