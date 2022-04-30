<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string|null $full_name
 * @property string $email
 * @property string $password
 * @property string|null $adress
 * @property string|null $phone_num
 * @property string|null $qin
 * @property string|null $passport
 * @property int|null $active
 * @property string $user_type
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string|null $description
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string $avatar
 * @property string $messenger_color
 * @property bool $dark_mode
 * @property bool $active_status
 *
 * @property Collection|UserDocuement[] $user_docuements
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

	protected $casts = [
		'active' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'dark_mode' => 'bool',
		'active_status' => 'bool'
	];

	protected $dates = [
		'start_date',
		'end_date',
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'full_name',
		'email',
		'password',
		'adress',
		'phone_num',
		'active',
		'user_type',
		'start_date',
		'end_date',
		'description',
		'email_verified_at',
		'remember_token',
		'created_by',
		'updated_by',
		'avatar',
		'messenger_color',
		'dark_mode',
		'active_status'
	];

	public function user_docuements()
	{
		return $this->hasMany(UserDocuement::class);
	}
}
