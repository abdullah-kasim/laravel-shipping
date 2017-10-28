<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Shipper\DuckTypes;


use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Shipper\DuckTypes\Traits\UserIdTrait;

class GetCheapestRate
{
    use UserIdTrait;
    public $item_id;
}