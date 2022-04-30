<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Chapitre
 * 
 * @property int $id
 * @property string|null $libelle
 *
 * @package App\Models
 */
class Chapitre extends Model
{
	protected $table = 'chapitres';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];
}
