# laravel-shipping

If you need to do dev on this, create a laravel project, and put the root in -
`packages/abdullahkasim/laravelshipping/`

Guided by http://laraveldaily.com/how-to-create-a-laravel-5-package-in-10-easy-steps/

# Plan

- Create API - param should be itemId, reply should be the shipping company with price
- Each shipment company will have a `from_address_id` and `to_address_id` and the price
- So we'll have `companies` `shipment_details` `addresses` `users` `items` `countries`
- Each item will have an `address_id` - this shall be the closest match that the server found.
- Each user will have an `address_id` - this shall be the closest match that the server found.
- **Remember, KEEP IT SIMPLE FIRST!**


# What can be overridden?
- The models - that means we'll create a factory with options - the user will be able to provide their own models
- The calculation method
- 

# DON'T DO THESE YET!
- shopping cart

# Commands

```bash
$ php artisan vendor:publish --tag=migrations
```


## What to do after launch?
- Allow multiple addresses per user.