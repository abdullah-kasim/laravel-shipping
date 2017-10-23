<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-24
 * Time: 12:27 AM
 */

namespace AbdullahKasim\LaravelShipping\Shipping\Main;


use AbdullahKasim\LaravelShipping\Models\Address;
use AbdullahKasim\LaravelShipping\Models\Interfaces\IShipmentDetail;
use AbdullahKasim\LaravelShipping\Models\Item;
use AbdullahKasim\LaravelShipping\Models\ShipmentDetail;
use AbdullahKasim\LaravelShipping\Models\User;
use AbdullahKasim\LaravelShipping\Shipping\Main\Exceptions\NoShipmentFound;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\ICalculator;
use Illuminate\Database\Eloquent\Model;

class Calculator implements ICalculator
{

    /**
     * @param Model|Item $item
     * @param Model|Address $toAddress
     * @return IShipmentDetail
     * @throws NoShipmentFound
     */
    public function getCheapestRateShipmentDetail(Model $item, Model $toAddress)
    {
        // Assume that we already have the ShipmentDetail mapping. Hence, this should be simple.
        // Let's find out where the item is. This will be the fromAddress.
        $fromAddress = $item->address;
        $shipmentDetails = ShipmentDetail::whereFromAddressId($fromAddress->id)
            ->whereToAddressId($toAddress->id)
            ->orderBy('cost')
            ->get();
        if ($shipmentDetails->isEmpty()) {
            throw new NoShipmentFound();
        }
        $shipmentDetail = $shipmentDetails->first();
        return $shipmentDetail;
    }
}