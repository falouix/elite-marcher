<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Projet
 *
 * @property int $id
 * @property string|null $code_pa
 * @property Carbon|null $date_projet
 * @property string|null $annee_gestion
 * @property string|null $objet
 * @property string|null $type_demande
 * @property string|null $nature_passation
 * @property int $source_finance
 * @property int|null $services_id
 * @property bool|null $transferer
 * @property int|null $duree_travaux_prvu
 * @property Carbon|null $date_cc_prvu
	* @property Carbon|null $date_avis_prvu
    	* @property Carbon|null $date_op_prvu
    	* @property Carbon|null $date_trsfert_ca_prvu
    	* @property Carbon|null $date_trsfert_cao_prvu
    	* @property Carbon|null $date_repca_prvu
    	* @property Carbon|null $date_pub_reslt_prvu
    	* @property Carbon|null $date_avis_soumissionaire_prvu
    	* @property Carbon|null $date_ordre_serv_prvu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Collection|LignesProjet[] $lignes_projets
 *
 * @package App\Models
 */
class Periodes extends Model
{
	use SoftDeletes;
	protected $table = 'periodes';

	protected $fillable = [
		'periode_cc_prvu',
	    'periodeavisprvu',
    	'periode_op_prvu',
    	'periode_trsfert_ca_prvu',
    	'periode_trsfert_cao_prvu',
    	'periode_repca_prvu',
    	'periode_pub_reslt_prvu',
    	'periode_avis_soumissionaire_prvu',
    	'periode_ordre_serv_prvu'
	];

}
