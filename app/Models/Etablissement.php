<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Etablissement
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $matricule_fiscale
 * @property string|null $email
 * @property string|null $adresse
 * @property string|null $responsable
 * @property string|null $entete
 * @property string|null $code_pa
 * @property string|null $code_consult
 * @property string|null $code_aon
 * @property string|null $code_aos
 * @property string|null $code_gg
 * @property bool|null $ajouter_annee
 * @property bool|null $reset_code
 * @property bool|null $notif_validation_besoins
 * @property bool|null $notif_pa
 * @property int|null $notif_duree_pa
 * @property bool|null $notif_publication_achat
 * @property int|null $notif_duree_publication
 * @property bool|null $notif_cc
 * @property int $notif_duree_cc
 * @property int $notif_avis_pub
 * @property int $notif_duree_pub
 * @property bool|null $notif_session_op
 * @property int|null $notif_duree_session_op
 * @property bool|null $notif_date_caution_final
 * @property int|null $notif_duree_caution_final
 * @property int|null $notif_caution_provisoire
 * @property int|null $notif_duree_caution_provisoire
 * @property bool|null $notif_delais_rp
 * @property int|null $notif_duree_rp
 * @property bool|null $notif_delais_rd
 * @property int|null $notif_duree_rd
 * @property int|null $notif_date_trsfert_ca_prvu
 * @property int|null $notif_duree_trsfert_ca_prvu
 * @property int|null $notif_date_trsfert_cao_prvu
 * @property int|null $notif_duree_trsfert_cao_prvu
 * @property int|null $notif_date_pub_reslt_prvu
 * @property int|null $notif_duree_pub_reslt_prvu
 * @property Carbon|null $datedeb_besoin
 * @property Carbon|null $datefin_besoin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class Etablissement extends Model
{
	use SoftDeletes;
	protected $table = 'etablissements';

	protected $casts = [
		'ajouter_annee' => 'bool',
		'reset_code' => 'bool',
		'notif_validation_besoins' => 'bool',
		'notif_pa' => 'bool',
		'notif_duree_pa' => 'int',
		'notif_publication_achat' => 'bool',
		'notif_duree_publication' => 'int',
		'notif_cc' => 'bool',
		'notif_duree_cc' => 'int',
		'notif_avis_pub' => 'int',
		'notif_duree_pub' => 'int',
		'notif_session_op' => 'bool',
		'notif_duree_session_op' => 'int',
		'notif_date_caution_final' => 'bool',
		'notif_duree_caution_final' => 'int',
		'notif_caution_provisoire' => 'int',
		'notif_duree_caution_provisoire' => 'int',
		'notif_delais_rp' => 'bool',
		'notif_duree_rp' => 'int',
		'notif_delais_rd' => 'bool',
		'notif_duree_rd' => 'int',
		'notif_date_trsfert_ca_prvu' => 'int',
		'notif_duree_trsfert_ca_prvu' => 'int',
		'notif_date_trsfert_cao_prvu' => 'int',
		'notif_duree_trsfert_cao_prvu' => 'int',
		'notif_date_pub_reslt_prvu' => 'int',
		'notif_duree_pub_reslt_prvu' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'datedeb_besoin',
		'datefin_besoin'
	];

	protected $fillable = [
		'libelle',
		'matricule_fiscale',
		'email',
		'adresse',
		'responsable',
		'entete',
		'code_pa',
		'code_consult',
		'code_aon',
		'code_aos',
		'code_gg',
		'ajouter_annee',
		'reset_code',
		'notif_validation_besoins',
		'notif_pa',
		'notif_duree_pa',
		'notif_publication_achat',
		'notif_duree_publication',
		'notif_cc',
		'notif_duree_cc',
		'notif_avis_pub',
		'notif_duree_pub',
		'notif_session_op',
		'notif_duree_session_op',
		'notif_date_caution_final',
		'notif_duree_caution_final',
		'notif_caution_provisoire',
		'notif_duree_caution_provisoire',
		'notif_delais_rp',
		'notif_duree_rp',
		'notif_delais_rd',
		'notif_duree_rd',
		'notif_date_trsfert_ca_prvu',
		'notif_duree_trsfert_ca_prvu',
		'notif_date_trsfert_cao_prvu',
		'notif_duree_trsfert_cao_prvu',
		'notif_date_pub_reslt_prvu',
		'notif_duree_pub_reslt_prvu',
		'datedeb_besoin',
		'datefin_besoin',
		'created_by',
		'updated_by'
	];
}
