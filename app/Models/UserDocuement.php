<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDocuement
 * 
 * @property int $id
 * @property string|null $file_name
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserDocuement extends Model
{
	protected $table = 'user_docuements';

	protected $casts = [
		'user_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'file_name',
		'path',
		'user_id',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
