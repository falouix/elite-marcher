<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * 
 * @property int $id
 * @property string $annee_gestion
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string $destination
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class News extends Model
{
	use SoftDeletes;
	protected $table = 'news';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'annee_gestion',
		'date_debut',
		'date_fin',
		'destination',
		'description',
		'created_by',
		'updated_by'
	];
}
