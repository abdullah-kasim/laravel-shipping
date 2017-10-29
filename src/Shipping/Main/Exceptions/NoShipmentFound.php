<?php


namespace AbdullahKasim\LaravelShipping\Shipping\Main\Exceptions;

use Throwable;

class NoShipmentFound extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("No shipment found", 404, $previous);
    }
}