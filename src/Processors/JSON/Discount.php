<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Discount {

    protected $discount;

    protected $properties = [
      'code' => 'code',
      'name' => 'name',
      'amount' => 'amount'
      'display' => 'display',
      'coupon_display_type' => '',
      'coupon_discount_details' => 'coupon_discount_details',
      'transaction_id',
      'customer_id'
    ];


    public function __construct($discount, $transaction_id, $customer_id)
    {

        $collection = [];

        foreach($this->properties as $d) {

          if(array_key_exists($prop, $d)) {

            $collection[$prop] = $discount[$prop];

          }

        }

        $collection['transaction_id']                  = $transaction_id;
        $collection['customer_id']                     = $customer_id;

        $this->discount = new Collection($collection);

    }


    public function get()
    {
        return $this->discount;
    }
}
