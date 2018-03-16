# FeedTheFox

A FoxyCart Datafeed Package for PHP

Use this package to handle post processing with FoxyCart.

If you use [FoxyCart](https://foxy.io) for your commerce website, you may be doing post-processing of order
using their DataFeed. 

For stores that require post processing orders (recording the order, emailing customers based on actions)...
this package makes it easier to work with the datafeed.

Install with composer, or download this package.
It does require laravel/collection to work.

With this package you can run tests on your own machine, or use it to process live transactions.

### This does not currently support multi-store or subscriptions, but will in updated versions.

```
composer require richtestani/feedthefox:dev-master
```

```
use RichTestani\FeedTheFox;

$config = [
    'key' => 'my-api-key',
    'encrypted' => false //set to false only if you are passing an xml string, otherwise you can remove this key
];

//new instance
$datafeed = new DataFeed($config);

//pass in the post array
$datafeed->process($_POST);

//get all of the customer data
$customer = $datafeed->customer();

//show just some data
echo $datafeed->customer->get('id');
echo $datafeed->customer->get('customer_first_name');

```

FeedTheFox breaks the data feed into logical groups, making it easier to 
work with and offers some helpful methods for each. Each group can be accessd from the instanced object,
in this case `$datafeed`


* Order
* Customers
* Transaction Details
* Discounts
* Custom Fields
* Shipping

For any object, you can retrieve a single piece of data, use the "get" method and pass in the name of the property. 
For example, to get the current transation id,

```
$datafeed->order->get('id');
```

To get the name of discount:

```
$datafeed->discounts->get('name');
```

* [Shipping](https://richtestani.github.io/FeedTheFox/shipping)
* [Customer](https://richtestani.github.io/FeedTheFox/customer)
* [Details](https://richtestani.github.io/FeedTheFox/details)