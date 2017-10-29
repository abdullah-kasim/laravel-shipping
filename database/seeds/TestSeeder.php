<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /** @var \Faker\Generator $faker */
    public $faker;
    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalCustomers = 100;
        $totalShippers = 10;
        $totalMerchants = 10;
        $itemsPerMerchant = 10;
        /** @var \AbdullahKasim\LaravelShipping\Models\Address[] $itemAddresses */
        $itemAddresses = [];
        /** @var \AbdullahKasim\LaravelShipping\Models\Address[] $customerAddresses */
        $customerAddresses = [];

        // We'll have one address per merchant, and one address per user for now.
        // imperative or functional?
        // Meh, let's do it imperative

        // customers
        for ($i = 0; $i < $totalCustomers; $i++)
        {
            $user = $this->createUser();
            $customer = $this->createCustomer($user);
            $address = $this->createAddress();
            $userAddress = $this->createUserAddress($address, $user);
            $customerAddresses[] = $address;
        }

        // merchants
        for ($i = 0; $i < $totalMerchants; $i++)
        {
            $user = $this->createUser();
            $merchant = $this->createMerchant($user);
            $address = $this->createAddress();
            $userAddress = $this->createUserAddress($address, $user);

            // items
            for ($j = 0; $j < $itemsPerMerchant; $j++)
            {
                $item = $this->createItem($merchant, $address);
                $itemAddresses[] = $address;
            }
        }
        // shippers
        for ($i = 0; $i < $totalShippers; $i++)
        {
            $user = $this->createUser();
            $shipper = $this->createShipper($user);
            $address = $this->createAddress();
            $userAddress = $this->createUserAddress($address, $user);

            // for each customer address and for each item address, create a shipment detail.
            foreach ($customerAddresses as $customerAddress) {
                foreach ($itemAddresses as $itemAddress) {
                    $shipmentDetail = $this->createShipmentDetails($shipper, $itemAddress, $customerAddress);
                }
            }
        }
    }

    /**
     * @return \AbdullahKasim\LaravelShipping\Models\User
     */
    public function createUser()
    {
        $user = new \AbdullahKasim\LaravelShipping\Models\User();
        $user->name = $this->faker->name;
        $user->email = $this->faker->email;
        $user->password = bcrypt($this->faker->password);
        $user->save();
        return $user;
    }

    /**
     * @return \AbdullahKasim\LaravelShipping\Models\Address
     */
    public function createAddress()
    {
        $address = new \AbdullahKasim\LaravelShipping\Models\Address();
        $address->country_id = \AbdullahKasim\LaravelShipping\Models\Country::all()->random()->id;
        $address->zip_code = $this->faker->postcode;
        $address->save();
        return $address;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\Address $address
     * @param \AbdullahKasim\LaravelShipping\Models\User $user
     * @return \AbdullahKasim\LaravelShipping\Models\UserAddress
     */
    public function createUserAddress($address, $user)
    {
        $userAddress = new \AbdullahKasim\LaravelShipping\Models\UserAddress();
        $userAddress->address_1 = $this->faker->address;
        $userAddress->address_2 = $this->faker->address;
        $userAddress->address_3 = $this->faker->address;
        $userAddress->address_id = $address->id;
        $userAddress->user_id = $user->id;
        $userAddress->save();
        return $userAddress;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\User $user
     * @return \AbdullahKasim\LaravelShipping\Models\Shipper
     */
    public function createShipper($user)
    {
        $shipper = new \AbdullahKasim\LaravelShipping\Models\Shipper();
        $user->shipper()->save($shipper);
        return $shipper;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\Shipper $shipper
     * @param \AbdullahKasim\LaravelShipping\Models\Address $fromAddress
     * @param \AbdullahKasim\LaravelShipping\Models\Address $toAddress
     * @return \AbdullahKasim\LaravelShipping\Models\ShipmentDetail
     */
    public function createShipmentDetails($shipper, $fromAddress, $toAddress)
    {
        /** @var \AbdullahKasim\LaravelShipping\Models\ShipmentDetail $shipmentDetails */
        $shipmentDetails = \AbdullahKasim\LaravelShipping\Models\ShipmentDetail::updateOrCreate([
            'shipper_id' => $shipper->id,
            'from_address_id' => $fromAddress->id,
            'to_address_id' => $toAddress->id,
            ], [
                'cost' => $this->faker->randomFloat(2, 0, 1000),
        ]);
        return $shipmentDetails;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\User $user
     * @return \AbdullahKasim\LaravelShipping\Models\Customer
     */
    public function createCustomer($user)
    {
        $customer = new \AbdullahKasim\LaravelShipping\Models\Customer();
        $user->customer()->save($customer);
        return $customer;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\User $user
     * @return \AbdullahKasim\LaravelShipping\Models\Merchant
     */
    public function createMerchant($user)
    {
        $merchant = new \AbdullahKasim\LaravelShipping\Models\Merchant();
        $user->merchant()->save($merchant);
        return $merchant;
    }

    /**
     * @param \AbdullahKasim\LaravelShipping\Models\Merchant $merchant
     * @param \AbdullahKasim\LaravelShipping\Models\Address $address
     * @return \AbdullahKasim\LaravelShipping\Models\Item
     */
    public function createItem($merchant, $address)
    {
        $item = new \AbdullahKasim\LaravelShipping\Models\Item();
        $item->address_id = $address->id;
        $item->merchant_id = $merchant->id;
        $item->name = $this->faker->jobTitle;
        $item->meta = null;
        $item->stock = $this->faker->numberBetween(0, 1000);
        $item->save();
        return $item;
    }

}
