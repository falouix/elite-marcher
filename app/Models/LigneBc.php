<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LigneBc
 * 
 * @property int $id
 * @property int $bcs_engagements_id
 * 
 * @property BcsEngagement $bcs_engagement
 *
 * @package App\Models
 */
class LigneBc extends Model
{
	protected $table = 'ligne_bcs';
	public $timestamps = false;

	protected $casts = [
		'bcs_engagements_id' => 'int'
	];

	protected $fillable = [
		'bcs_engagements_id'
	];

	public function bcs_engagement()
	{
		return $this->belongsTo(BcsEngagement::class, 'bcs_engagements_id');
	}
}
