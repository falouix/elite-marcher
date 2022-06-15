<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $file_name
 * @property integer $besoins_id
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class BesoinsDoc extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['file_name', 'besoins_id', 'path', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by'];
}
