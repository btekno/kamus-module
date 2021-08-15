<?php

namespace Modules\Qamus\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Makna extends Model
{
    use SoftDeletes;
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'kms_makna';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'kata_id', 
		'bahasa_id', 
        'kata', 
		'terjemahan', 
		'penggalan', 
		'lafal', 
		'audio', 
		'gambar', 
		'verified', 
		'user_id'
	];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indonesia()
    {
    	return $this->belongsTo(\Modules\Qamus\Entities\Kata::class, 'kata_id');
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bahasa()
    {
    	return $this->belongsTo(\Modules\Qamus\Entities\Bahasa::class, 'bahasa_id');
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(\Modules\My\Entities\User::class, 'user_id');
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contoh()
    {
        return $this->hasMany(\Modules\Qamus\Entities\Contoh::class, 'terjemahan_id');
    }
}
