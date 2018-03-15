# FeedTheFox

A FoxyCart Datafeed Package

Use this package to handle post processing with FoxyCart.

If you use [FoxyCart](https://foxy.io) for your commerce website, you may be doing post-processing of order
using their DataFeed. 

For stores that require post processing orders (recording the order, emailing customers based on actions)...
this package makes it easier to work with the datafeed.

Install with composer, or download this package.
It does require laravel/collection to work.

```
composer require richtestani/feedthefox:dev-master
```

```
use RichTestani\FeedTheFox;

//new instance
$datafeed = new DataFeed('my-foxy-api');
$datafeed->process();

if( $datafeed->order->transactionDeclined() ) {
    //mail me about this issue.
}

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

* [Shipping](./shipping)