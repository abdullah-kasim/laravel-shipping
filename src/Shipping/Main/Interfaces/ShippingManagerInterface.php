<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces;


use AbdullahKasim\LaravelShipping\Models\Interfaces\ShipmentDetailInterface;
use Illuminate\Database\Eloquent\Model;

interface ShippingManagerInterface
{
    /**
     * @param Model $item
     * @param $toAddress
     * @return ShipmentDetailInterface
     */
    public function getCheapestRate($item, $toAddress);
}