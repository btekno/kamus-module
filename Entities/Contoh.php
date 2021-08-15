<?php

namespace Modules\Qamus\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contoh extends Model
{
    use SoftDeletes;
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'kms_contoh';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'terjemahan_id', 
        'kalimat_indo', 
		'kalimat', 
		'audio', 
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
    public function makna()
    {
    	return $this->belongsTo(\Modules\Qamus\Entities\Makna::class, 'terjemahan_id');
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
}
