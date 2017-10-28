<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-24
 * Time: 12:27 AM
 */

namespace AbdullahKasim\LaravelShipping\Shipping\Main;


use AbdullahKasim\LaravelShipping\Models\Address;
use AbdullahKasim\LaravelShipping\Models\Interfaces\ShipmentDetailInterface;
use AbdullahKasim\LaravelShipping\Models\Item;
use AbdullahKasim\LaravelShipping\Models\ShipmentDetail;
use AbdullahKasim\LaravelShipping\Models\User;
use AbdullahKasim\LaravelShipping\Shipping\Main\Exceptions\NoShipmentFound;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\CalculatorInterface;
use Illuminate\Database\Eloquent\Model;

class Calculator implements CalculatorInterface
{

    /**
     * @param Model|Item $item
     * @param User $user
     * @return ShipmentDetail
     * @throws NoShipmentFound
     * @internal param User $toAddress
     */
    public function getCheapestRate($item, $user)
    {
        $shipmentDetails = ShipmentDetail::whereFromAddressId($item->address_id)
            ->whereIn('address_id', $user->addresses()->allRelatedIds()->toArray())
            ->orderBy('cost')
            ->get();
        if ($shipmentDetails->isEmpty()) {
            throw new NoShipmentFound();
        }
        $shipmentDetail = $shipmentDetails->first();
        return $shipmentDetail;
    }
}