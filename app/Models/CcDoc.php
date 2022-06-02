<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CcDoc
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $path
 * @property int $cahiers_charges_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * 
 * @property CahiersCharge $cahiers_charge
 *
 * @package App\Models
 */
class CcDoc extends Model
{
	use SoftDeletes;
	protected $table = 'cc_docs';

	protected $casts = [
		'cahiers_charges_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'libelle',
		'path',
		'cahiers_charges_id',
		'created_by',
		'updated_by'
	];

	public function cahiers_charge()
	{
		return $this->belongsTo(CahiersCharge::class, 'cahiers_charges_id');
	}
}
