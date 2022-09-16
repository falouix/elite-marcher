<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notif
 *
 * @property int $id
 * @property string $type
 * @property bool $valider
 * @property string $texte
 * @property string $user_group
 * @property string|null $from_table
 * @property int|null $from_table_id
 * @property int|null $users_id
 * @property Carbon|null $read_at
 * @property string $action
 * @property Carbon|null $date_action
 * @property int|null $traiter_par
 * @property Carbon|null $date_traitement
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Notif extends Model
{
	use SoftDeletes;
	protected $table = 'notifs';

	protected $casts = [
		'valider' => 'bool',
		'from_table_id' => 'int',
		'users_id' => 'int',
		'traiter_par' => 'int'
	];

	protected $dates = [
		'read_at',
		'date_action',
		'date_traitement'
	];

	protected $fillable = [
		'type',
		'valider',
		'texte',
		'user_group',
		'from_table',
		'from_table_id',
		'users_id',
		'read_at',
		'action',
		'date_action',
		'traiter_par',
		'date_traitement'
	];
    public function lignes_notifs()
	{
		return $this->hasMany(LignesNotif::class, 'notifs_id');
	}
}
