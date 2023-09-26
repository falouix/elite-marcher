<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LignesNotif
 *
 * @property int $id
 * @property string $users_ids
 * @property Carbon|null $read_at
 * @property int $notifs_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LignesNotif extends Model
{
	use SoftDeletes;
	protected $table = 'lignes_notifs';

	protected $casts = [
		'notifs_id' => 'int'
	];

	protected $dates = [
		'read_at'
	];

	protected $fillable = [
		'users_ids',
		'read_at',
		'notifs_id'
	];
    public function getReadAtAttribute()
    {
        return (new Carbon($this->attributes['read_at']))->format('Y-m-d H:m');
    }
    public function notifs()
	{
		return $this->belongsTo(Notifs::class, 'notifs_id');
	}
}
