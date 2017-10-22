<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id
 * @property int $country_id
 * @property string $zip_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property Country $country
 * @property \Illuminate\Database\Eloquent\Collection $items
 * @property \Illuminate\Database\Eloquent\Collection $shipment_details
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 *
 */
class Address extends Eloquent
{
	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'zip_code'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function items()
	{
		return $this->hasMany(Item::class);
	}

	public function shipment_details()
	{
		return $this->hasMany(ShipmentDetail::class, 'to_address_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_addresses')
					->withPivot('id', 'address_1', 'address_2', 'address_3')
					->withTimestamps();
	}
}
