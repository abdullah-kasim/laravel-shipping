<?php

namespace AbdullahKasim\LaravelShipping\Models\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface IShipmentDetail
{
    /** @return Model */
    public function getShipper();
    /** @return Model */
    public function getFromAddress();
    /** @return int */
    public function getCost();
}