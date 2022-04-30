<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $contact
 * @property string|null $responsable
 * 
 * @property Collection|Besoin[] $besoins
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';
	public $timestamps = false;

	protected $fillable = [
		'libelle',
		'contact',
		'responsable'
	];

	public function besoins()
	{
		return $this->hasMany(Besoin::class, 'services_id');
	}
}
