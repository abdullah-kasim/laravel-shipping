<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $deleted_at
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 *
 *
 */
class User extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'remember_token'
	];

	public function customer()
	{
		return $this->hasOne(Customer::class);
	}

	public function merchant()
	{
		return $this->hasOne(Merchant::class);
	}

	public function shipper()
	{
		return $this->hasOne(Shipper::class);
	}

	public function addresses()
	{
		return $this->belongsToMany(Address::class, 'user_addresses')
					->withPivot('id', 'address_1', 'address_2', 'address_3')
					->withTimestamps();
	}
}
