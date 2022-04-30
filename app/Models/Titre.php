<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Titre
 * 
 * @property int $id
 * @property string|null $libelle
 *
 * @package App\Models
 */
class Titre extends Model
{
	protected $table = 'titres';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];
}
