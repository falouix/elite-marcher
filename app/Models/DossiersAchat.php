<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DossiersAchat
 * 
 * @property int $id
 * @property int|null $code_projet
 * @property string|null $code_dossier
 * @property int|null $situation_dossier
 * @property string|null $objet_dossier
 * @property string|null $organisme_financier
 * @property int|null $source_finance
 * @property string|null $nature_finance
 * @property bool|null $type_dossier
 * @property string|null $type_demande
 * @property string|null $type_commission
 * @property Carbon|null $date_cloture
 * @property string|null $dossiers_achatscol
 * 
 * @property Annulation $annulation
 * @property Collection|AvisDossier[] $avis_dossiers
 * @property Collection|BcsEngagement[] $bcs_engagements
 * @property Collection|CahiersCharge[] $cahiers_charges
 * @property Cloture $cloture
 * @property Collection|CommissionsOp[] $commissions_ops
 * @property Collection|CommissionsTechnique[] $commissions_techniques
 * @property Collection|DossierDoc[] $dossier_docs
 * @property Collection|Enregistrement[] $enregistrements
 * @property Collection|LignesDossier[] $lignes_dossiers
 * @property Collection|Offre[] $offres
 * @property Collection|Reception[] $receptions
 * @property Collection|ServiceOrdre[] $service_ordres
 *
 * @package App\Models
 */
class DossiersAchat extends Model
{
	protected $table = 'dossiers_achats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'code_projet' => 'int',
		'situation_dossier' => 'int',
		'source_finance' => 'int',
		'type_dossier' => 'bool'
	];

	protected $dates = [
		'date_cloture'
	];

	protected $fillable = [
		'code_projet',
		'code_dossier',
		'situation_dossier',
		'objet_dossier',
		'organisme_financier',
		'source_finance',
		'nature_finance',
		'type_dossier',
		'type_demande',
		'type_commission',
		'date_cloture',
		'dossiers_achatscol'
	];

	public function annulation()
	{
		return $this->hasOne(Annulation::class, 'dossiers_achats_id');
	}

	public function avis_dossiers()
	{
		return $this->hasMany(AvisDossier::class, 'dossiers_achats_id');
	}

	public function bcs_engagements()
	{
		return $this->hasMany(BcsEngagement::class, 'dossiers_achats_id');
	}

	public function cahiers_charges()
	{
		return $this->hasMany(CahiersCharge::class, 'dossiers_achats_id');
	}

	public function cloture()
	{
		return $this->hasOne(Cloture::class, 'dossiers_achats_id');
	}

	public function commissions_ops()
	{
		return $this->hasMany(CommissionsOp::class, 'dossiers_achats_id');
	}

	public function commissions_techniques()
	{
		return $this->hasMany(CommissionsTechnique::class, 'dossiers_achats_id');
	}

	public function dossier_docs()
	{
		return $this->hasMany(DossierDoc::class, 'dossiers_achats_id');
	}

	public function enregistrements()
	{
		return $this->hasMany(Enregistrement::class, 'dossiers_achats_id');
	}

	public function lignes_dossiers()
	{
		return $this->hasMany(LignesDossier::class, 'dossiers_achats_id');
	}

	public function offres()
	{
		return $this->hasMany(Offre::class, 'dossiers_achats_id');
	}

	public function receptions()
	{
		return $this->hasMany(Reception::class, 'dossiers_achats_id');
	}

	public function service_ordres()
	{
		return $this->hasMany(ServiceOrdre::class, 'dossiers_achats_id');
	}
}
