# Details

The details model contains everything related to your products.
The models contains an array of items, each with a set of product options.

The details model is the most complex because this reflects a line item as an object rather than individual items.
Each item within an iteration would be an item to output.

```
$details = $datafeed->details();

foreach($details->get() as $item) {

  //Item object
  $product = $item->get('product_name');
  $code = $item->get('product_code');
  
  echo 'There are '.$product->numItems().' in this order.';

  if($item->hasOptions()) {
  
    $options = $item->options();

    foreach($options as $option) {
      $optName = $options->get('product_option_name');
    }
  }

}
```


The following methods are available to the detail model.


```
get($property = null)
```
Returns a single value, or and entire array. If no property name is provided, the entire collection is returned.

```
options()
```
Returns all product options for all items

```
hasOptions()
```
Returns true if there are any options in this order

```
numItems()
```
Returns an integer of the number of items in this order

```
numOptions()
```
Returns an integer for the number of options in this total order

```
numItems()
```
Returns an integer with the number of items in the order

{% include menu.md %}
