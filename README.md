# laravel-shipping

# Usage

```bash
# install the package

# publish the migration and the seeder
php artisan vendor:publish --tag=migrations
php artisan vendor:publish --tag=seeders

# do a migration
php artisan migrate

# for testing, run this seeder
php artisan db:seed --classs=TestSeeder

# to enable the test api that are prefixed with /tests (see routes/tests.php) (don't do this in production!)
echo "LARAVEL_SHIPPING_TESTING=true" >> .env

```

Then, in your php code:

```php
<?php

class SomeClass {
  public function someFunc(ShippingManager $manager, $item, $toAddress) {
    $manager->getCheapestRate($item, $toAddress);
  }
}

```

# dev

If you need to do dev on this, create a laravel project, and put the root in -
`packages/abdullahkasim/laravelshipping/`

Guided by http://laraveldaily.com/how-to-create-a-laravel-5-package-in-10-easy-steps/

# Next Plan
- Use closest distance instead of exact matches.

# Won't implement
- shopping cart 



# Commands

```bash
$ php artisan vendor:publish --tag=migrations
```

# Coding standards

Use http://www.php-fig.org/bylaws/psr-naming-conventions/ except for the namespace prefix
