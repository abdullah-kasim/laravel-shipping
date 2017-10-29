<?php
$addUser = new \AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\DuckTypes\AddUser();
$addUser->password = 'testPassword1234!@';
$addUser->email = 'testEmail@gmail.com';
$addUser->name = 'testName';
$I = new ApiTester($scenario);
$I->wantTo('add user and get back user from db');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendPOST('/addUser', $addUser);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContainsJson([
    'meta' => [
        'status' => true
    ]
]);
