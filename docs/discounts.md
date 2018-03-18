# Discounts

The discounts model provides a set of properties and methods to help better determine handling of discoutned orders.
Use the `get` method to retriveve a poroptry or set of proerty values.

```
$discounts = $datafeed->discounts>get();
```
The above will return a collection of data.

```
foreach($discounts as $d) {
    echo $d->get('code');
}
```

You can also get the discount model to work with the other methods.
```
$discounts = $datafeed->discounts();

if($discounts->hasDiscount() && $discounts->hasCode('BOGO')) {
    //take come action here
}

```
hasDiscount()
```
Returns true or false if the order has discount data

```
hasCode($code)
```
Returns true or false if the provided code is in the order
