<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Shipper
 * 
 * @property int $id
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $shipment_details
 *
 *
 */
class Shipper extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function shipment_details()
	{
		return $this->hasMany(ShipmentDetail::class);
	}
}
