<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Annulation
 * 
 * @property Carbon|null $date_annul
 * @property Carbon|null $date_decision
 * @property int $dossiers_achats_id
 * @property int $soumissionnaires_id
 * @property string $annul_doc
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
class Annulation extends Model
{
	use SoftDeletes;
	protected $table = 'annulations';
	public $incrementing = false;

	protected $casts = [
		'dossiers_achats_id' => 'int',
		'soumissionnaires_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_annul',
		'date_decision'
	];

	protected $fillable = [
		'date_annul',
		'date_decision',
		'dossiers_achats_id',
		'soumissionnaires_id',
		'annul_doc',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
