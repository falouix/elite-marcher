<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LignesProjet
 *
 * @property int $id
 * @property int|null $num_lot
 * @property string|null $libelle
 * @property int $articles_id
 * @property int|null $qte
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int $type_demande
 * @property int $nature_demandes_id
 * @property int $projets_id
 * @property int $lignes_besoin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Projet $projet
 *
 * @package App\Models
 */
class LignesProjet extends Model
{
	use SoftDeletes;
	protected $table = 'lignes_projets';

	protected $casts = [
		'id' => 'int',
		'num_lot' => 'int',
		'lignes_besoin_id' => 'int',
		'articles_id' => 'int',
		'qte' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'type_demande' => 'int',
		'nature_demandes_id' => 'int',
		'projets_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'num_lot',
		'libelle',
		'articles_id',
		'lignes_besoin_id',
		'qte',
		'cout_unite_ttc',
		'cout_total_ttc',
		'type_demande',
		'nature_demandes_id',
		'projets_id',
		'created_by',
		'updated_by'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}
    public function nature_demande()
	{
		return $this->belongsTo(NatureDemande::class, 'nature_demandes_id');
	}
    public function ligneBesoin()
	{
		return $this->belongsTo(LignesBesoin::class, 'lignes_besoin_id');
	}
}
