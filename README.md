# FeedTheFox
A FoxyCart Datafeed Package

Use this package to handle post processing with FoxyCart.

For stores that require post processing orders (recording the order, emailing customers based on actions)...
this package makes it easier to work with their data file.

Install with composer, or download this package.
It does require laravel/collection to work.

//new instance
$datafeed = new DataFeed('my-foxy-api');

if all is well, you can do whatever with the data.

The data is broken into logical objects:
Order
Customers
Transaction Details
Discounts
Custom Fields
Shipping

