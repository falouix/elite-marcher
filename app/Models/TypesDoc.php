<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypesDoc
 *
 * @property int $id
 * @property string|null $libelle
 * @property string|null $type_doc
 *
 * @package App\Models
 */
class TypesDoc extends Model
{
    /*
    **TYPE DOCS :
    'RECEPTION_OFFRES',    'SESSION_OP',
    'SESSION_OP',    'COM_OPTECH',
    'ENGAGEMENT',    'ENREGISTREMENT',
    'ORDRE_SERVICE',    'RECEPTIONPROVISOIRE',
    'RECEPTIONDEFINITIVE', 'CLOTURE',
    'ANNULATION'
    **
    */
	protected $table = 'types_docs';
	public $timestamps = false;

	protected $fillable = [
		'libelle',
		'type_doc'
	];


}
