<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChMessage
 * 
 * @property int $id
 * @property string $type
 * @property int $from_id
 * @property int $to_id
 * @property string|null $body
 * @property string|null $attachment
 * @property bool $seen
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ChMessage extends Model
{
	protected $table = 'ch_messages';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'from_id' => 'int',
		'to_id' => 'int',
		'seen' => 'bool'
	];

	protected $fillable = [
		'type',
		'from_id',
		'to_id',
		'body',
		'attachment',
		'seen'
	];
}
