<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChFavorite
 * 
 * @property int $id
 * @property int $user_id
 * @property int $favorite_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ChFavorite extends Model
{
	protected $table = 'ch_favorites';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'favorite_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'favorite_id'
	];
}
