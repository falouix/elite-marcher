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
 * @property int|null $libelle
 * @property int|null $qte
 * @property float|null $cout_unite_ttc
 * @property float|null $cout_total_ttc
 * @property int $projets_id
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
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'num_lot' => 'int',
		'libelle' => 'int',
		'qte' => 'int',
		'cout_unite_ttc' => 'float',
		'cout_total_ttc' => 'float',
		'projets_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'num_lot',
		'libelle',
		'qte',
		'cout_unite_ttc',
		'cout_total_ttc',
		'projets_id',
		'created_by',
		'updated_by'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'projets_id');
	}
}
