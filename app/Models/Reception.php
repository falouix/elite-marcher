<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reception
 * 
 * @property int $id
 * @property Carbon|null $date_reception
 * @property int|null $type_reception
 * @property int|null $duree_retard
 * @property float|null $taux_avancement
 * @property string|null $reception_doc
 * @property int $dossiers_achats_id
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
class Reception extends Model
{
	use SoftDeletes;
	protected $table = 'receptions';

	protected $casts = [
		'type_reception' => 'int',
		'duree_retard' => 'int',
		'taux_avancement' => 'float',
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_reception'
	];

	protected $fillable = [
		'date_reception',
		'type_reception',
		'duree_retard',
		'taux_avancement',
		'reception_doc',
		'dossiers_achats_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}
}
