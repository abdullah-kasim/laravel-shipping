<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes;


use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\Traits\UserIdTrait;

class AddUserAddress
{
    use UserIdTrait;
    public $address_1;
    public $address_2;
    public $address_3;
    public $country_id;
    public $zip_code;
}