<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Main;


use AbdullahKasim\LaravelShipping\Models\Interfaces\IShipmentDetail;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\ICalculator;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\IShipping;
use Illuminate\Database\Eloquent\Model;

class Shipping implements IShipping
{
    /** @var  ICalculator */
    public $calculator;
    public function __construct(ICalculator $calculator = null)
    {
        $calculatorObj = $calculator === null ? new Calculator() : $calculator;
        $this->calculator = $calculatorObj;
    }

    /**
     * @param Model $item
     * @param Model $toAddress
     * @return IShipmentDetail
     * @internal param int $itemId
     * @internal param int $userId
     */
    public function getCheapestRateShipmentDetail(Model $item, Model $toAddress)
    {
        return $this->calculator->getCheapestRateShipmentDetail($item, $toAddress);
    }
}