<?php

namespace AbdullahKasim\LaravelShipping\Shipping\Http\Controllers;

use AbdullahKasim\LaravelShipping\Models\Address;
use AbdullahKasim\LaravelShipping\Models\Customer;
use AbdullahKasim\LaravelShipping\Models\Item;
use AbdullahKasim\LaravelShipping\Models\Merchant;
use AbdullahKasim\LaravelShipping\Models\ShipmentDetail;
use AbdullahKasim\LaravelShipping\Models\Shipper;
use AbdullahKasim\LaravelShipping\Models\User;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddCustomer;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddMerchant;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddShipmentDetail;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddShipper;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddUserAddress;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Obj\MetaStatusFalse;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Obj\MetaStatusTrue;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddItem;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddUser;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\GetAddresses;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\GetCheapestRate;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Validations\Validations;
use AbdullahKasim\LaravelShipping\Shipping\Main\Obj\AddressDetails;
use AbdullahKasim\LaravelShipping\Shipping\Main\ShippingManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShipperController extends Controller
{
    /**
     * @param Request|GetAddresses $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddresses(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new GetAddresses();
        $validationObj->user_id = Validations::USER_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array) new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $customer = Customer::whereUserId($request->user_id);
        $addresses = $shippingManager->getAddresses(Customer::whereUserId($request->user_id)->first());
        return \Response::json([
            'meta' => (array)new MetaStatusTrue(),
            'data' => $addresses->toArray(),
        ]);
    }

    /**
     * @param Request|GetCheapestRate $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCheapestRate(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new GetCheapestRate();
        $validationObj->address_id = Validations::ADDRESS_ID;
        $validationObj->item_id = Validations::ITEM_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $toAddress = Address::find($request->address_id);
        $item = Item::find($request->item_id);
        $shipmentDetails = $shippingManager->getCheapestRate($item, $toAddress);
        $meta = new MetaStatusTrue();
        return \Response::json([
            'meta' => (array)$meta,
            'data' => $shipmentDetails->toArray(),
        ]);
    }

    /**
     * @param Request|AddShipper $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addShipper(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddShipper();
        $validationObj->user_id = Validations::USER_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $shipper = $shippingManager->addShipper(User::find($request->user_id));
        $meta = new MetaStatusTrue();
        return \Response::json([
            'meta' => (array)$meta,
            'data' => $shipper->toArray(),
        ]);
    }

    /**
     * @param Request|AddMerchant $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMerchant(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddMerchant();
        $validationObj->user_id = Validations::USER_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $merchant = $shippingManager->addMerchant(User::find($request->user_id));
        $meta = new MetaStatusTrue();
        return \Response::json([
            'meta' => (array)$meta,
            'data' => $merchant->toArray(),
        ]);
    }

    /**
     * @param Request|AddShipmentDetail $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addShipmentDetail(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddShipmentDetail();
        $validationObj->from_address_id = Validations::ADDRESS_ID;
        $validationObj->to_address_id = Validations::ADDRESS_ID;
        $validationObj->cost = Validations::COST;
        $validationObj->shipper_id = Validations::SHIPPER_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $shipmentDetail = new ShipmentDetail();
        $shipmentDetail->from_address_id = $request->from_address_id;
        $shipmentDetail->to_address_id = $request->to_address_id;
        $shipmentDetail->cost = $request->cost;
        $shipper = Shipper::find($request->shipper_id);
        // running this function is completely pointless. You could just assign shipper_id and then save.
        $returnedShipmentDetail = $shippingManager->addShipmentDetail($shipper,$shipmentDetail);
        return \Response::json([
            'meta' => (array) new MetaStatusTrue(),
            'data' => $returnedShipmentDetail->toArray(),
        ]);
    }

    /**
     * @param Request|AddCustomer $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustomer(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddCustomer();
        $validationObj->user_id = Validations::USER_ID;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $customer = $shippingManager->addCustomer(User::find($request->user_id));
        $meta = new MetaStatusTrue();
        return \Response::json([
            'meta' => (array)$meta,
            'data' => $customer->toArray(),
        ]);
    }


    /**
     * @param Request|AddUserAddress $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUserAddress(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddUserAddress();
        $validationObj->user_id = Validations::USER_ID;
        $validationObj->country_id = Validations::COUNTRY_ID;
        $validationObj->zip_code = Validations::ZIP_CODE;
        $validationObj->address_1 = 'required|'.Validations::ADDRESS_FIELD;
        $validationObj->address_2 = Validations::ADDRESS_FIELD;
        $validationObj->address_3 = Validations::ADDRESS_FIELD;
        $validator = \Validator::make($request->toArray(), (array) $validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $addressDetails = new AddressDetails();
        $addressDetails->zipCode = $request->zip_code;
        $addressDetails->countryId = $request->country_id;
        $addressDetails->address1 = $request->address_1;
        $addressDetails->address2 = $request->address_2;
        $addressDetails->address3 = $request->address_3;
        $address = $shippingManager->addUserAddress(User::find($request->user_id), $addressDetails);
        $address->load('address');

        return \Response::json([
            'meta' => (array)new MetaStatusTrue(),
            'data' => $address->toArray(),
        ]);
    }

    /**
     * @param Request|AddItem $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItem(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddItem();
        $validationObj->name = Validations::ITEM_NAME;
        $validationObj->meta = Validations::META;
        $validationObj->address_id = Validations::ADDRESS_ID;
        $validationObj->merchant_id = Validations::MERCHANT_ID;
        $validationObj->stock = Validations::STOCK;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $meta = isset($request->meta) ? $request->meta : null;
        $item = new Item();
        $item->name = $request->name;
        $item->meta = $meta;
        $item->address_id = $request->address_id;
        $item->merchant_id = $request->merchant_id;
        $item->stock = $request->stock;
        $savedItem = $shippingManager->addItem(Merchant::find($request->merchant_id), $item);
        return \Response::json([
            'meta' => (array)new MetaStatusTrue(),
            'data' => $savedItem->toArray(),
        ]);
    }

    /**
     *
     * @param Request|AddUser $request
     * @param ShippingManager $shippingManager
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser(Request $request, ShippingManager $shippingManager)
    {
        $validationObj = new AddUser();
        $validationObj->name = Validations::USER_ACTUAL_NAME;
        $validationObj->email = Validations::EMAIL;
        $validationObj->password = Validations::PASSWORD;
        $validator = \Validator::make($request->toArray(), (array)$validationObj);
        if ($validator->fails()) {
            return \Response::json([
                'meta' => (array)new MetaStatusFalse(),
                'data' => $validator->errors()->toArray(),
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return \Response::json([
            'meta' => (array) new MetaStatusTrue(),
            'data' => $user->toArray(),
        ]);
    }
}
