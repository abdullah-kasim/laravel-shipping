<?php
/**
 * Created by IntelliJ IDEA.
 * User: Adekhaha2
 * Date: 2017-10-24
 * Time: 1:22 AM
 */

namespace AbdullahKasim\LaravelShipping\Shipping\Main\Exceptions;



use Throwable;

class NoShipmentFound extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("No shipment found", 404, $previous);
    }
}