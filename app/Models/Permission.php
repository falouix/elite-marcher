<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $name_ar
 * @property string $guard_name
 * @property string $table_name_en
 * @property string $table_name_ar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ModelHasPermission[] $model_has_permissions
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permissions';

	protected $fillable = [
		'name',
		'name_en',
		'name_ar',
		'guard_name',
		'table_name_en',
		'table_name_ar'
	];

	public function model_has_permissions()
	{
		return $this->hasMany(ModelHasPermission::class);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'role_has_permissions');
	}
}
