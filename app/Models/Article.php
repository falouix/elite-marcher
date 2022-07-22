<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * 
 * @property int $id
 * @property string $libelle
 * @property bool|null $valider
 * @property Carbon|null $date_validation
 * @property int $natures_demande_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $validated_by
 *
 * @package App\Models
 */
class Article extends Model
{
	use SoftDeletes;
	protected $table = 'articles';

	protected $casts = [
		'valider' => 'bool',
		'natures_demande_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'validated_by' => 'int'
	];

	protected $dates = [
		'date_validation'
	];

	protected $fillable = [
		'libelle',
		'valider',
		'date_validation',
		'natures_demande_id',
		'created_by',
		'updated_by',
		'validated_by'
	];
}
