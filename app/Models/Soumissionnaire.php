<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Soumissionnaire
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $matricule_fiscale
 * @property string|null $email
 * @property string|null $adresse
 * @property string|null $contact
 * @property string|null $code_postal
 * @property string|null $gouvernorat
 * @property string|null $ville
 * @property string|null $tel_fax
 *
 * @package App\Models
 */
class Soumissionnaire extends Model
{
	protected $table = 'soumissionnaires';
	public $timestamps = false;

	protected $fillable = [
		'libelle',
		'matricule_fiscale',
		'email',
		'adresse',
		'contact',
		'code_postal',
		'gouvernorat',
		'ville',
		'tel_fax'
	];
	
}
