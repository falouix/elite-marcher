<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class Soumissionnaire extends Model
{
	use SoftDeletes;
	protected $table = 'soumissionnaires';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'matricule_fiscale',
		'email',
		'adresse',
		'contact',
		'code_postal',
		'gouvernorat',
		'ville',
		'tel_fax',
		'created_by',
		'updated_by'
	];
}
