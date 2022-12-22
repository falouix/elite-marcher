<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CahiersCharge
 *
 * @property int $id
 * @property int|null $type_reception
 * @property int|null $type_overture_plis
 * @property float|null $prix_cc
 * @property int|null $duree_travaux
 * @property float|null $caution_prov
 * @property int|null $duree_caution_prov
 * @property float|null $caution_def
 * @property int|null $duree_caution_def
 * @property float|null $autres_caution
 * @property int|null $duree_autres_caution
 * @property Carbon|null $date_pub_prevu
 * @property int $dossiers_achats_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property DossiersAchat $dossiers_achat
 * @property Collection|CcDoc[] $cc_docs
 *
 * @package App\Models
 */
class CahiersCharge extends Model
{
	use SoftDeletes;
	protected $table = 'cahiers_charges';

	protected $casts = [
		'type_reception' => 'int',
		'type_overture_plis' => 'int',
		'prix_cc' => 'float',
		'duree_travaux' => 'int',
		'caution_prov' => 'float',
		'duree_caution_prov' => 'int',
		'caution_def' => 'float',
		'duree_caution_def' => 'int',
		'autres_caution' => 'float',
		'duree_autres_caution' => 'int',
		'dossiers_achats_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'date_pub_prevu'
	];

	protected $fillable = [
		'type_reception',
		'type_overture_plis',
		'prix_cc',
		'duree_travaux',
		'caution_prov',
		'duree_caution_prov',
		'caution_def',
		'duree_caution_def',
		'autres_caution',
		'duree_autres_caution',
		'date_pub_prevu',
		'dossiers_achats_id',
		'created_by',
		'updated_by'
	];

	public function dossiers_achat()
	{
		return $this->belongsTo(DossiersAchat::class, 'dossiers_achats_id');
	}

	public function cc_docs()
	{
		return $this->hasMany(CcDoc::class, 'cahiers_charges_id');
	}
    public function getDatePubPrevuAttribute()
    {
        return (new Carbon($this->attributes['date_pub_prevu']))->format('Y-m-d');
    }
}
