# FeedTheFox

A FoxyCart Datafeed Package for PHP

A JSON & XML webhook post processing library.

If you use [FoxyCart](https://foxy.io) for your commerce website, often you'll want to record the transaction on your own server, or do something custom that FoxyCart doesn't do.

FeedTheFox recieves your transactions and makes it easy to pluck the content you need from either the JSON webhook or the XML Datafeed. It's built around Laravel libraries, but does not require the framework.

### This does not currently support multi-store or subscriptions, but will in updated versions.

h3. How to set up the XML Datafeed.

In your FoxyCart admin, click the 'Advanced' link under the STORE heading. Check the 'would you like the enable your store datafeed', then enter where your php file is located. For example, if your site is coolshop.com, you might have your script at `coolshop.com/integrations/datafeed.php`

On your server, make sure you have composer installed then run the command below on your terminal.

```
composer require richtestani/feedthefox:dev-master
```

In your php file, copy the code below and paste it. In the FoxyCart admin, where you turned on the datafeed, copy the store secret and replace the 'my-api-key' with its contents.

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
work with and offers some helpful methods for each. Each group can be accessed from the instanced object,
in this case `$datafeed`


* Order
* Customers
* Transaction Details
* Discounts
* Custom Fields
* Shipping
* Payments
* Taxes

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