<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-24
 * Time: 1:51 AM
 */

namespace AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces;


use AbdullahKasim\LaravelShipping\Models\Interfaces\IShipmentDetail;
use Illuminate\Database\Eloquent\Model;

interface IShipping
{
    /**
     * @param Model $item
     * @param Model $toAddress
     * @return IShipmentDetail
     * @internal param int $itemId
     * @internal param int $userId
     */
    public function getCheapestRateShipmentDetail(Model $item, Model $toAddress);
}