<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use AbdullahKasim\LaravelShipping\Models\Interfaces\ShipmentDetailInterface;
use AbdullahKasim\LaravelShipping\Models\Traits\DefaultShipmentDetailTraits;
use Illuminate\Database\Eloquent\Model;
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
 * @property Address $from_address
 * @property Address $to_address
 * @property Shipper $shipper
 *
 *
 */
class ShipmentDetail extends Eloquent implements ShipmentDetailInterface
{
    use DefaultShipmentDetailTraits;

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

	public function from_address()
	{
		return $this->belongsTo(Address::class, 'from_address_id');
	}

    public function to_address()
    {
        return $this->belongsTo(Address::class, 'to_address_id');
    }

	public function shipper()
	{
		return $this->belongsTo(Shipper::class);
	}
}
