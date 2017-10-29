<?php


namespace AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Validations;


class Validations
{
    const SPECIAL_CHARACTERS = '!@#$%^&*()\-_=+ ';
    const REGEX_DEFAULT_NAME = 'regex:/^[0-9a-zA-Z'.self::SPECIAL_CHARACTERS.']+$/';

    const USER_ID = 'required|exists:users';
    const CUSTOMER_ID = 'required|exists:customers';
    const ITEM_ID = 'required|exists:items';
    const ADDRESS_ID = 'required|exists:addresses';
    const COST = 'required|numeric|min:0|max:1000';
    const STOCK = 'required|integer|min:0|max:100000';
    const SHIPPER_ID = 'required|exists:shippers';
    const COUNTRY_ID = 'required|exists:countries';
    const ZIP_CODE = 'required|alpha_num|max:10'; // let me know if there are any zip codes that has dashes or spaces
    const MERCHANT_ID = 'required|exists:merchants';

    const ITEM_NAME = 'required|min:0|max:250|'.self::REGEX_DEFAULT_NAME;
    const META = 'json';
    const USER_ACTUAL_NAME = 'required|min:0|max:50|'.self::REGEX_DEFAULT_NAME;
    const EMAIL = 'required|email';
    const PASSWORD = 'required|min:6|max:250|password';
}