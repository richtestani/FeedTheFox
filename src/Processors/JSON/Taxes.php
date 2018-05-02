<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Taxes {

  protected $taxes;

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

  public function __construct($taxes, $transaction_id, $customer_id)
  {

    $tax = [];
    foreach($this->properties as $prop)
    {
      if(in_array($prop, $taxes)) {
        $tax[$prop] = $taxes[$prop];
      }
    }

    $this->taxes = new Collection($tax);
  }

  public function get()
  {
    return $this->taxes;
  }

}
