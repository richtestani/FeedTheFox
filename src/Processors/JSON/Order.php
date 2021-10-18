<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Order {

    protected $order;

    protected $properties = [

      'id' => 'id',
      'customer_id' => 'id',
      'store_id' => 'store_id',
      'data_is_fed' => 'data_is_fed',
      'is_hidden' => 'is_hidden',
      'is_test' => 'is_test',
      'transaction_date' => 'transaction_date',
      'processor_reponse' => 'processor_response',
      'is_anonymous' => 'is_anonymous',
      'minfraud_score' => 'fraud_protection_score',
      'purchase_order' => 'purchase_order',

      'cc_number_masked' => 'cc_number_masked',
      'cc_type' => 'cc_type',
      'cc_exp_month' => 'cc_exp_month',
      'cc_exp_year' => 'cc_exp_year',
      'cc_start_date_month' => 'cc_start_date_month',
      'cc_start_date_year' => 'cc_start_date_year',
      'cc_issue_number' => 'cc_issue_number',

      'product_total' => 'total_item_price',
      'tax_total'  => 'total_tax',
      'shipping_total' => 'total_shipping',
      'order_total' => 'total_price',
	  'currency_code' => 'currency_code',
	  'currency_symbol' => 'currency_symbol',

      'shipping_first_name' => 'shipping_first_name',
      'shipping_last_name' => 'shipping_last_name',
      'shipping_company' => 'shipping_company',
      'shipping_address1' => 'address1',
      'shipping_address2' => 'address2',
      'shipping_city' => 'city',
      'shipping_state' => 'region',
      'shipping_postal_code' => 'postal_code',
      'shipping_country' => 'country',
      'shipping_phone' => 'phone',
      'shipto_shipping_service_description' => 'shipping_service_description',

      'payment_gateway_type' => 'payment_gateway_type',
      'receipt_url' => 'receipt_url',
      'taxes' => 'taxes',

      'status' => 'status',
    ];

    public function __construct($transaction, $customer_id)
    {

        $order = [];

        $billing = $transaction['_embedded']['fx:billing_addresses'][0];
        $shipping = $transaction['_embedded']['fx:shipments'][0];
        $customer = $transaction['_embedded']['fx:customer'];

        $merged = array_merge($shipping, $customer, $transaction);

        foreach($this->properties as $prop => $map) {

          if(array_key_exists($map, $merged)) {
            $order[$prop] = $merged[$map];
          }

        }

        $order['customer_id'] = $customer_id;

        $this->order = new Collection($order);

    }

    public function get()
    {
        return $this->order;
    }

    public function getId()
    {
        return $this->order->get('id');
    }


}
