<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DossiersAchat
 *
 * @property int $id
 * @property string|null $annee_gestion
 * @property string|null $code_projet
 * @property string|null $code_dossier
 * @property int|null $situation_dossier
 * @property string|null $objet_dossier
 * @property string|null $organisme_financier
 * @property int|null $source_finance
 * @property string|null $nature_finance
 * @property string|null $type_dossier
 * @property string|null $type_demande
 * @property string|null $type_commission
 * @property Carbon|null $date_cloture
 * @property string|null $dossiers_achatscol
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $soumissionaire_id
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
	use SoftDeletes;
	protected $table = 'dossiers_achats';

	protected $casts = [
		'id' => 'int',
		'situation_dossier' => 'int',
		'source_finance' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_cloture'
	];

	protected $fillable = [
		'code_projet',
		'code_dossier',
		'situation_dossier',
		'objet_dossier',
        'annee_gestion',
		'organisme_financier',
		'source_finance',
		'nature_finance',
		'type_dossier',
		'type_demande',
		'type_commission',
		'date_cloture',
		'dossiers_achatscol',
		'created_by',
		'updated_by',
        'soumissionaire_id'
	];

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });
        static::created(function ($model) {
            $settings =\App\Models\Etablissement::first();
            $count = \DB::table('dossiers_achats')
            ->select(\DB::raw('count(*) as count'))
            ->count();
            switch ($model->type_dossier) {
                case 'CONSULTATION':
                    $codeDossier =  $settings->code_consult;
                    break;
                case 'AOS':
                    $codeDossier =  $settings->code_aos;
                    break;
                case 'AON':
                    $codeDossier = $settings->code_aon;
                    break;
                case 'AOGREGRE':
                    $codeDossier = $settings->code_gg;
                    break;
                default :
                $codeDossier = str_pad($count.'/'. date('Y'), 6, '0', STR_PAD_LEFT);
                break;
            }
            if($settings->ajouter_annee){
                $code = \Str::replaceFirst('{code}', str_pad($count, 4, '0', STR_PAD_LEFT), $codeDossier);
                $code = \Str::replaceFirst('{annee}', date('Y'), $code);
            }else{
                $code = \Str::replaceFirst('{code}', str_pad($count, 4, '0', STR_PAD_LEFT), $codeDossier);
            }
            Log::alert("code dossier cccc: model :".$model->type_dossier." ".$codeDossier);
            Log::alert("code dossier : ".$code);
            $model->code_dossier = $code;
            $model->save();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
        static::deleting(function ($client) {
            $relationMethods = ['lignes_dossiers', 'cahiers_charges', 'bcs_engagements', 'commissions_ops', 'offres', 'receptions'];
            //$relationMethods = ['LignesBesoin'];

            foreach ($relationMethods as $relationMethod) {
                if ($client->$relationMethod()->count() > 0) {
                    session()->flash('delete_error', "You can't delete a workorder that has a Continuation");
                    return false;
                    break;
                }
            }
        });
    }


	public function annulation()
	{
		return $this->hasOne(Annulation::class, 'dossiers_achats_id')->withDefault();
	}

	public function avis_dossiers()
	{
		return $this->hasOne(AvisDossier::class, 'dossiers_achats_id')->withDefault();
	}

	public function bcs_engagements()
	{
		return $this->hasMany(BcsEngagement::class, 'dossiers_achats_id');
	}

	public function cahiers_charges()
	{
		return $this->hasOne(CahiersCharge::class, 'dossiers_achats_id')->withDefault();
	}

	public function cloture()
	{
		return $this->hasOne(Cloture::class, 'dossiers_achats_id')->withDefault();
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
