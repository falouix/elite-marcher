<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Enregistrement
 * 
 * @property int $id
 * @property Carbon|null $date_signature
 * @property Carbon|null $date_enregistrement
 * @property Carbon|null $date_copie_unique
 * @property string|null $ref_copie_unique
 * @property int|null $type_enregistrement
 * @property int $dossiers_achats_id
 * @property int $soumissionnaires_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property DossiersAchat $dossiers_achat
 *
 * @package App\Models
 */
class Enregistrement extends Model
{
	use SoftDeletes;
	protected $table = 'enregistrements';

	protected $casts = [
		'type_enregistrement' => 'int',
		'dossiers_achats_id' => 'int',
		'soumissionnaires_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_signature',
		'date_enregistrement',
		'date_copie_unique'
	];

	protected $fillable = [
		'date_signature',
		'date_enregistrement',
		'date_copie_unique',
		'ref_copie_unique',
		'type_enregistrement',
		'dossiers_achats_id',
		'soumissionnaires_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
