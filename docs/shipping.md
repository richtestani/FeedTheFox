# Shipping

The shipping model contains everything related to shipping.

The following properties are available with the `get()` method.

* shipping_first_name
* shipping_last_name
* shipping_company
* shipping_address1
* shipping_address2
* shipping_city
* shipping_state
* shipping_postal_code
* shipping_country
* shipping_phone
* shipto_shipping_service_description
* shipping_total

The following methods are available to the shipping model.


```
get($property = null)
```
Returns a single value, or and entire array. If no property name is provided, the entire array is returned.

```
hasShippingName($name)
```
Returns true if the shipping name is equal to the name provided.

```
shippingCostIsGreaterThan($amount)
```
Returns true if the amount is greater than the shipping total.

```
shippingCostIsLessThan($amount)
```
Returns true if the amount is less than the shipping total.
