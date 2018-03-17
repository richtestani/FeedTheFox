# Details

The details model contains everything related to your products.
The models contains an array of items, each with a set of product options.

The following properties are available with the `get()` method.

* transaction


The following methods are available to the detail model.


```
get($property = null)
```
Returns a single value, or and entire array. If no property name is provided, the entire array is returned.

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
Returns an intger of the number of items in this order

```
numOptions()
```
Returns an intefer for the number of options in this total order
