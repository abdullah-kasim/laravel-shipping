<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-28
 * Time: 10:38 AM
 */

namespace AbdullahKasim\LaravelShipping\Models\Traits;



trait DefaultShipmentDetailTraits
{
    public function getCost() {
        return $this->cost;
    }

    public function getFromAddress()
    {
        return $this->from_address;
    }

    public function getToAddress()
    {
        return $this->to_address;
    }

    /** @return Model */
    public function getShipper()
    {
        return $this->shipper;
    }
}