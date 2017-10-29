<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $name
 * @property int $merchant_id
 * @property int $address_id
 * @property int $stock
 * @property string $meta
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property Address $address
 * @property Merchant $merchant
 *
 *
 */
class Item extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'merchant_id' => 'int',
		'address_id' => 'int',
		'stock' => 'int'
	];

	protected $fillable = [
		'name',
		'merchant_id',
		'address_id',
		'stock',
        'meta'
	];

	public function address()
	{
		return $this->belongsTo(Address::class);
	}

	public function merchant()
	{
		return $this->belongsTo(Merchant::class);
	}
}
