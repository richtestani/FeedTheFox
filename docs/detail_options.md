# Detail Options

The options are setup as a nested array, much like transaction details are.

You can request the options in a few ways.

* From the datafeed object

```
$options = $datafeed->options();
```

* Or from the details get method
```
$options = $datafeed->details->get('transaction_detail_options');

* And finally from a details 

