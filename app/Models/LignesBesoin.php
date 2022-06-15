<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * Class LignesBesoin
 *
 * @property int $id
 * @property string|null $libelle
 * @property int|null $qte_demande
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int|null $qte_valide
 * @property int $besoins_id
 * @property int|null $projets_id
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
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'qte_demande' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'qte_valide' => 'int',
		'besoins_id' => 'int',
		'projets_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'qte_demande',
		'cout_unite_ttc',
		'cout_total_ttc',
		'qte_valide',
		'besoins_id',
		'projets_id',
		'created_by',
		'updated_by'
	];
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

	public function besoin()
	{
		return $this->belongsTo(Besoin::class, 'besoins_id');
	}
}
