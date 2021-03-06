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
use RichTestani\FeedTheFox\DataFeed;

$config = [
    'key' => 'my-api-key',
    'encrypted' => false //set to false only if you are passing an xml string, otherwise you can remove this key
];

//new instance
$datafeed = new DataFeed($config);

//pass in the post array
$datafeed->process();

//get all of the customer data
$customer = $datafeed->customer();

//verbose mothod of getting data
echo $datafeed->customer->get('id');
echo $datafeed->customer->get('customer_first_name');

//show the order id
echo $datafeed->order->get('id');

You can get the object with the short hand method
$order = $datafeed->order();
echo $order->get('id');

//you can also use the methods on the object
if( $order->transactionDeclined() ) {
    echo 'this transaction was declined';
}

//show the transaction product names
$names = $datafeed->details->get('product_name');

foreach($names as $name) {
    echo '<li>'.$name.'</li>';
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

{% include menu.md %}