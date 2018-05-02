# Customer

The customer model contains everything related to customer.

The following properties are available with the `get()` method.

* customer_id
* customer_email
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
```
**Example:**
$customer = $datafeed->customer();

$customer_data = [
  'id' => $customer->get('customer_id'),
  'first' => $customer->get('customer_first_name'),
  'last' => $customer->get('customer_last_name')
];

if( $customer->isGuest() ) {
  mail($customer->get('customer_email'), 'thankyou@company.com', 'Thank you for your order!');
}

```

Returns a single value, or and entire array. If no property name is provided, the entire array is returned.

```
isGuest()
```
Returns true if the customer does not have an id.

{% include menu.md %}
