<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 22 Oct 2017 18:53:19 +0000.
 */

namespace AbdullahKasim\LaravelShipping\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $iso
 * @property string $name
 * @property string $nice_name
 * @property string $iso_3
 * @property string $num_code
 * @property string $phone_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 *
 *
 */
class Country extends Eloquent
{
	protected $fillable = [
		'iso',
		'name',
		'nice_name',
		'iso_3',
		'num_code',
		'phone_code'
	];

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}
}
