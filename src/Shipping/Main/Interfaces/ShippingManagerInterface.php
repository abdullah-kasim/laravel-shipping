<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-24
 * Time: 1:51 AM
 */

namespace AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces;


use AbdullahKasim\LaravelShipping\Models\Interfaces\ShipmentDetailInterface;
use Illuminate\Database\Eloquent\Model;

interface ShippingManagerInterface
{
    /**
     * @param Model $item
     * @param Model $toAddress
     * @return ShipmentDetailInterface
     * @internal param int $itemId
     * @internal param int $userId
     */
    public function getCheapestRate($item, $toAddress);
}