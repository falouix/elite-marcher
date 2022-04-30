<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paragraphe
 * 
 * @property int $id
 * @property string|null $libelle
 *
 * @package App\Models
 */
class Paragraphe extends Model
{
	protected $table = 'paragraphes';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];
}
