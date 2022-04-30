<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property string|null $code_ao
 * @property bool|null $ajouter_annee
 * @property bool|null $reset_code
 * @property bool|null $notif_validation_besoins
 * @property bool|null $notif_pa
 * @property int|null $notif_duree_pa
 * @property bool|null $notif_publication_achat
 * @property int|null $notif_duree_publication
 * @property bool|null $notif_session_op
 * @property int|null $notif_duree_session_op
 * @property bool|null $notif_date_caution_final
 * @property int|null $notif_duree_caution_final
 * @property bool|null $notif_delais_rp
 * @property int|null $notif_duree_rp
 * @property bool|null $notif_delais_rd
 * @property int|null $notif_duree_rd
 *
 * @package App\Models
 */
class Etablissement extends Model
{
	protected $table = 'etablissements';
	public $timestamps = false;

	protected $casts = [
		'ajouter_annee' => 'bool',
		'reset_code' => 'bool',
		'notif_validation_besoins' => 'bool',
		'notif_pa' => 'bool',
		'notif_duree_pa' => 'int',
		'notif_publication_achat' => 'bool',
		'notif_duree_publication' => 'int',
		'notif_session_op' => 'bool',
		'notif_duree_session_op' => 'int',
		'notif_date_caution_final' => 'bool',
		'notif_duree_caution_final' => 'int',
		'notif_delais_rp' => 'bool',
		'notif_duree_rp' => 'int',
		'notif_delais_rd' => 'bool',
		'notif_duree_rd' => 'int'
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
		'code_ao',
		'ajouter_annee',
		'reset_code',
		'notif_validation_besoins',
		'notif_pa',
		'notif_duree_pa',
		'notif_publication_achat',
		'notif_duree_publication',
		'notif_session_op',
		'notif_duree_session_op',
		'notif_date_caution_final',
		'notif_duree_caution_final',
		'notif_delais_rp',
		'notif_duree_rp',
		'notif_delais_rd',
		'notif_duree_rd'
	];
}
