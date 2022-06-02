<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LigneBc
 * 
 * @property int $id
 * @property int $bcs_engagements_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property BcsEngagement $bcs_engagement
 *
 * @package App\Models
 */
class LigneBc extends Model
{
	use SoftDeletes;
	protected $table = 'ligne_bcs';

	protected $casts = [
		'bcs_engagements_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'bcs_engagements_id',
		'created_by',
		'updated_by'
	];

	public function bcs_engagement()
	{
		return $this->belongsTo(BcsEngagement::class, 'bcs_engagements_id');
	}
}
