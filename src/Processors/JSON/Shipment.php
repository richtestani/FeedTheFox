<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Shipment {

  protected $shipment;

  protected $properties = [
      'amount',
      'apply_to_handling',
      'apply_to_shipping',
      'date_created',
      'date_modified',
      'is_future_tax',
      'name' => 'Global Tax',
      'rate',
      'shipto',
      'transaction_id',
      'customer_id'
  ];

  public function __construct($shipment, $transaction_id, $customer_id)
  {

    $s = [];
    foreach($this->properties as $prop)
    {
      if(in_array($prop, $shipment)) {

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
