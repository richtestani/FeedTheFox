# FeedTheFox

A FoxyCart Datafeed Package

Use this package to handle post processing with FoxyCart.

If you use [FoxyCart](https://foxy.io) for your commerce website, you may be using the datafeed feature to further process your orders.

For stores that require post processing orders (recording the order, emailing customers based on actions, etc.),
FeedTheFox makes it easier to work with the generated feeds by taking care of the heavy lifting of parsing the very complex XML & JSON files.

Currently works with their XML datafeed feed & JSON Web Hook Integration for single transactions.
*Updated will include subcriptions and multi-ship feeds.*

Install with composer, or download this package.
It does require laravel/collection to work & PHP 7.1 or greater.

```
composer require richtestani/feedthefox
```

```
use RichTestani\FeedTheFox\DataFeed;

//new instance
$datafeed = new DataFeed('my-foxy-key');
$datafeed->process();

if( $datafeed->order->transactionDeclined() ) {
    //mail me about this issue.
}

```

FeedTheFox breaks the data feed into logical groups, making it easier to
work with and offers some helpful methods for each. Each group can be accessed from the instanced object,
in this case `$datafeed`


* Order
* Customers
* Transaction Details
* Discounts
* Custom Fields
* Shipping
* Payments (JSON only)

Read more in the [docs](https://richtestani.github.io/FeedTheFox/)
