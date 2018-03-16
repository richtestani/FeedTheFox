# Order

The order model supplies you with everything generally about an order.

The following properties are available through the get method.

`datafeed->order->get('id');`

* id
* customer_id
* store_id
* data_is_fed
* is_hidden
* is_test
* transaction_date
* processor_response
* is_anonymous
* minfraud_score
* purchase_order

* cc_number_masked
* cc_type
* cc_exp_month
* cc_exp_year
* cc_start_date_month
* cc_start_date_year
* cc_issue_number

* product_total
* tax_total
* shipping_total
* order_total

* shipping_first_name
* shipping_last_name
* shipping_company
* shipping_addtress1
* shipping_address2
* shipping_city
* shipping_state
* shipping_postal_code
* shipping_country
* shipping_phone
* shipto_shipping_service_description

* payment_gateway_type
* receipt_url
* taxes

Methods available

```
transactionDeclined()
```
Returns true if the order status is desclined

```
transactionApproved()
```
Returns true if the order status is approved
