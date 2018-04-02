<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Customer {

    protected $customer;

    protected $properties = [
      'customer_ip' => 'customer_ip',
      'customer_id' => 'id',
      'customer_first_name' => 'first_name',
      'customer_last_name' => 'last_name',
      'customer_company' => 'company',
      'customer_email' => 'email',
      'customer_password' => 'password_hash',
      'password_hash_config' => 'password_hash_config',
      'password_hash_type' => 'password_hash_type',
      'password_salt' => 'password_salt',
      'customer_address1' => 'address1',
      'customer_address' => 'address2',
      'customer_city' => 'city',
      'customer_state' => 'region',
      'customer_postal_code' => 'customer_postal_code',
      'customer_country' => 'customer_country',
      'customer_phone' => 'customer_phone',
      'minfraud_score' => 'fraud_protection_score',
      'is_anonymous' => 'is_anonymous',
      'tax_id' => 'tax_id',
      'date_created' => 'date_created',
      'date_modified' => 'date_modified',
      'forgot_password' => 'forgot_password',
      'forgot_password_timestamp' => 'forgot_password_timestamp'
    ];


    public function __construct($transaction)
    {

      $billing = $transaction['_embedded']['fx:billing_addresses'][0];
      $shipping = $transaction['_embedded']['fx:shipments'][0];
      $customer = $transaction['_embedded']['fx:customer'];

      $merged = array_merge($transaction, $shipping, $billing, $customer);


      $customer = [];

      foreach($this->properties as $prop => $map) {

        if(array_key_exists($map, $merged)) {
          $customer[$prop] = $merged[$map];
        }

      }

        $this->customer = new collection($customer);

    }

    public function get() {

        return $this->customer;

    }

    public function getId()
    {
        return $this->customer->get('customer_id');
    }
}
