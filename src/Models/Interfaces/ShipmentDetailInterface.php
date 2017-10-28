<?php

namespace AbdullahKasim\LaravelShipping\Models\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface ShipmentDetailInterface
{
    /** @return Model */
    public function getShipper();
    /** @return Model */
    public function getFromAddress();
    /** @return Model */
    public function getToAddress();
    /** @return int */
    public function getCost();
}