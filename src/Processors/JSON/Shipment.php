<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Shipment {

  protected $shipment;

  protected $properties = [
      'country',
      'shipping_service_id',
      'shipping_service_description',
      'total_price',
      'address1',
      'address2',
      'city',
      'date_created',
      'date_modified',
      'first_name',
      'last_name',
      'postal_code',
      'region',
      'phone',
      'company',
      'total_shipping',
      'transaction_id',
      'customer_id'
  ];

  public function __construct($shipment, $transaction_id, $customer_id)
  {

    $s = [];
    foreach($this->properties as $prop)
    {
      if(array_key_exists($prop, $shipment)) {

        $s[$prop] = $shipment[$prop];

      }
    }

    $s['transaction_id'] = $transaction_id;
    $s['customer_id'] = $customer_id;
    $this->shipment = new Collection($s);
  }

  public function get()
  {
    return $this->shipment;
  }

}
