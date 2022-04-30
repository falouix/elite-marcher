<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CcDoc
 * 
 * @property int $id
 * @property string|null $libelle
 * @property string|null $path
 * @property int $cahiers_charges_id
 * 
 * @property CahiersCharge $cahiers_charge
 *
 * @package App\Models
 */
class CcDoc extends Model
{
	protected $table = 'cc_docs';
	public $timestamps = false;

	protected $casts = [
		'cahiers_charges_id' => 'int'
	];

	protected $fillable = [
		'libelle',
		'path',
		'cahiers_charges_id'
	];

	public function cahiers_charge()
	{
		return $this->belongsTo(CahiersCharge::class, 'cahiers_charges_id');
	}
}
