<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ShipmentDetail
 * 
 * @property int $id
 * @property int $shipper_id
 * @property int $from_address_id
 * @property int $to_address_id
 * @property int $cost
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property Address $address
 * @property Shipper $shipper
 *
 *
 */
class ShipmentDetail extends Eloquent
{
	protected $casts = [
		'shipper_id' => 'int',
		'from_address_id' => 'int',
		'to_address_id' => 'int',
		'cost' => 'int'
	];

	protected $fillable = [
		'shipper_id',
		'from_address_id',
		'to_address_id',
		'cost'
	];

	public function address()
	{
		return $this->belongsTo(Address::class, 'to_address_id');
	}

	public function shipper()
	{
		return $this->belongsTo(Shipper::class);
	}
}
