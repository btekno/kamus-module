<?php

namespace Modules\Qamus\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kata extends Model
{
    use SoftDeletes;
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'kms_kata';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kata'
	];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function makna()
    {
        return $this->hasMany(\Modules\Qamus\Entities\Makna::class, 'bahasa_id');
    }
}
