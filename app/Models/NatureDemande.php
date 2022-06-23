<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NatureDemande
 *
 * @property int $id
 * @property string $libelle
 * @property int $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class NatureDemande extends Model
{
	use SoftDeletes;
	protected $table = 'nature_demandes';

	protected $casts = [
		'type' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'type',
		'created_by',
		'updated_by'
	];
}
