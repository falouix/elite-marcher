<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ServiceOrdre
 * 
 * @property int $id
 * @property Carbon|null $date_ordre
 * @property Carbon|null $date_reception_ordre
 * @property string|null $ref_ordre
 * @property int $dossiers_achats_id
 * @property int|null $soumissionnaires_id
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
class ServiceOrdre extends Model
{
	use SoftDeletes;
	protected $table = 'service_ordres';

	protected $casts = [
		'dossiers_achats_id' => 'int',
		'soumissionnaires_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_ordre',
		'date_reception_ordre'
	];

	protected $fillable = [
		'date_ordre',
		'date_reception_ordre',
		'ref_ordre',
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
