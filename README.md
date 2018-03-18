# FeedTheFox

A FoxyCart Datafeed Package

Use this package to handle post processing with FoxyCart.

If you use [FoxyCart](https://foxy.io) for your commerce website, you may be using the datafeed feature to further process and order.

For stores that require post processing orders (recording the order, emailing customers based on actions, etc.),
FeedTheFox makes it easier to work with the genereated feeds. 

Currenly works with their XML feed with a sinle transaction.
*Updated will include subcriptions and mult-ship feeds.*

Install with composer, or download this package.
It does require laravel/collection to work.

```
composer require richtestani/feedthefox
```

```
use RichTestani\FeedTheFox\DataFeed;

//new instance
$datafeed = new DataFeed('my-foxy-key');
$datafeed->process($_POST);

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
Read more in the [docs](https://richtestani.github.io/FeedTheFox/)
