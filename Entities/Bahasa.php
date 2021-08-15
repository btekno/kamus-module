<?php

namespace Modules\Qamus\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Ramsey\Uuid\Uuid;

class Bahasa extends Model
{
    use SoftDeletes;
	
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'kms_bahasa';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'uuid', 
		'kode', 
		'nama', 
		'info', 
		'wilayah', 
		'jumlah_pengguna'
	];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
	 *  Setup model event hooks
	 */
	public static function boot()
	{
		parent::boot();
		self::creating(function ($model) {
			$model->uuid = (string) Uuid::uuid1()->toString();
		});
	}

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
