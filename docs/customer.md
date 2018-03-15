# Cust

The customer model contains everything related to customer.

The following properties are available with the `get()` method.

* customer_first_name
* customer_last_name
* customer_company
* customer_address1
* customer_address2
* customer_city
* customer_state
* customer_postal_code
* customer_country
* customer_phone
* customer_total
* is_anonymous

The following methods are available to the customer model.


```
get($property = null)
```
Returns a single value, or and entire array. If no property name is provided, the entire array is returned.

```
isGuest()
```
Returns true if the customer does not have.

