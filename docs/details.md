# Details

The details model contains everything related to your products.
The models contains an array of items, each with a set of product options.

The following properties are available with the `get()` method.

* transaction

* id
* transaction_date

* product_name
* product_price
* product_quantity
* product_weight
* product_code
* parent_code
* image
* url
* length
* width
* height
* expires

* sub_token_url
* subscription_frequency
* subscription_startdate
* subscription_nextdate
* subscription_enddate

* is_future_line_item
* shipto
* category_description
* category_code
* product_delivery_type

* transaction_detail_options

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
getAllValuesByProperty($property)
```
Returns all values given proptry name.
