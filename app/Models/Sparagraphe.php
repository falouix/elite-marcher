<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sparagraphe
 * 
 * @property int $id
 * @property string|null $libelle
 *
 * @package App\Models
 */
class Sparagraphe extends Model
{
	protected $table = 'sparagraphes';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];
}
