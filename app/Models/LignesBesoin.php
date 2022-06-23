<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LignesBesoin
 *
 * @property int $id
 * @property string|null $libelle
 * @property int|null $qte_demande
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int|null $qte_valide
 * @property string|null $description
 * @property int|null $docs_id
 * @property int $besoins_id
 * @property int|null $projets_id
 * @property int|null $type_demande
 * @property int|null $nature_demandes_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Besoin $besoin
 *
 * @package App\Models
 */
class LignesBesoin extends Model
{
	use SoftDeletes;
	protected $table = 'lignes_besoins';

    protected static function boot()
    {
        parent::boot();
        // auto-sets values on creation
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }

	protected $casts = [
		'qte_demande' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'qte_valide' => 'int',
		'docs_id' => 'int',
		'besoins_id' => 'int',
		'projets_id' => 'int',
		'type_demande' => 'int',
		'nature_demandes_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'qte_demande',
		'cout_unite_ttc',
		'cout_total_ttc',
		'qte_valide',
		'description',
		'docs_id',
		'besoins_id',
		'projets_id',
		'type_demande',
		'nature_demandes_id',
		'created_by',
		'updated_by'
	];

	public function besoin()
	{
		return $this->belongsTo(Besoin::class, 'besoins_id');
	}
    public function nature_demande()
	{
		return $this->belongsTo(NatureDemande::class, 'nature_demandes_id');
	}
    public function document()
	{
		return $this->belongsTo(BesoinsDoc::class, 'docs_id');
	}
}
