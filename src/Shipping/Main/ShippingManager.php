<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Main;


use AbdullahKasim\LaravelShipping\Models\Address;
use AbdullahKasim\LaravelShipping\Models\Customer;
use AbdullahKasim\LaravelShipping\Models\Interfaces\ShipmentDetailInterface;
use AbdullahKasim\LaravelShipping\Models\Item;
use AbdullahKasim\LaravelShipping\Models\Merchant;
use AbdullahKasim\LaravelShipping\Models\ShipmentDetail;
use AbdullahKasim\LaravelShipping\Models\Shipper;
use AbdullahKasim\LaravelShipping\Models\User;
use AbdullahKasim\LaravelShipping\Models\UserAddress;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\CalculatorInterface;
use AbdullahKasim\LaravelShipping\Shipping\Main\Interfaces\ShippingManagerInterface;
use AbdullahKasim\LaravelShipping\Shipping\Main\Obj\AddressDetails;
use Illuminate\Database\Eloquent\Model;


/**
 * The core of this package.
 * Feel free to override/implement whatever is in ShippingManagerInterface and CalculatorInterface
 *
 * The other methods and classes are for providing sensible defaults so that this package can work out of the box.
 *
 *
 * Class ShippingManager
 * @package AbdullahKasim\LaravelShipping\Shipping\Main
 */
class ShippingManager implements ShippingManagerInterface
{
    /** @var CalculatorInterface */
    public $calculator;

    /**
     * ShippingManager constructor.
     * @param CalculatorInterface $calculator
     */
    public function __construct($calculator = null)
    {
        $this->calculator = $calculator === null ? new Calculator() : $calculator;
    }

    /**
     * @param Item $item
     * @param Address $toAddress
     * @return ShipmentDetailInterface|ShipmentDetail
     */
    public function getCheapestRate($item, $toAddress)
    {
        return $this->calculator->getCheapestRate($item, $toAddress);
    }

    /**
     * @param Customer $customer
     * @return Address[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAddresses($customer)
    {
        return $customer->user->addresses;
    }

    /**
     * @param User $user
     * @return Shipper|false
     */
    public function addShipper($user)
    {
        $shipper = new Shipper();
        return $user->shipper()->save($shipper);
    }

    /**
     * @param User $user
     * @return false|Merchant
     */
    public function addMerchant($user)
    {
        $merchant = new Merchant();
        return $user->merchant()->save($merchant);
    }

    /**
     * @param Shipper $shipper
     * @param ShipmentDetail $shipmentDetail
     * @return false|ShipmentDetail
     */
    public function addShipmentDetail($shipper, $shipmentDetail)
    {
        return $shipper->shipment_details()->save($shipmentDetail);
    }

    /**
     * @param User $user
     * @return false|Customer
     */
    public function addCustomer($user)
    {
        $customer = new Customer();
        return $user->customer()->save($customer);
    }

    /**
     * @param User $user
     * @param AddressDetails $addressDetails
     * @return UserAddress
     */
    public function addUserAddress($user, $addressDetails)
    {
        // Users may have multiple addresses.
        /** @var Address $address */
        $address = Address::firstOrCreate([
                'country_id' => $addressDetails->countryId,
                'zip_code' => $addressDetails->zipCode,
            ]);
        $userAddress = new UserAddress();
        $userAddress->address_1 = $addressDetails->address1;
        $userAddress->address_2 = $addressDetails->address2;
        $userAddress->address_3 = $addressDetails->address3;
        $userAddress->user_id = $user->id;
        $userAddress->address_id = $address->id;
        $userAddress->save();
        return $userAddress;
    }

    /**
     * @param Merchant $merchant
     * @param Item $item
     * @return false|Item
     */
    public function addItem($merchant, $item)
    {
        return $merchant->items()->save($item);
    }
}