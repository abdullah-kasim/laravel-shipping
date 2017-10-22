<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserAddress
 * 
 * @property int $id
 * @property int $user_id
 * @property string $address_1
 * @property string $address_2
 * @property string $address_3
 * @property int $address_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property Address $address
 * @property User $user
 *
 *
 */
class UserAddress extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'address_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'address_1',
		'address_2',
		'address_3',
		'address_id'
	];

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
