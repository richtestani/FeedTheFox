<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Discount {

    protected $discount;

    protected $properties = [
      'code',
      'name',
      'amount',
      'display',
      'coupon_display_type',
      'coupon_discount_details',
      'transaction_id',
      'customer_id'
    ];


    public function __construct($discount, $transaction_id, $customer_id)
    {

        $collection = [];

        foreach($this->properties as $prop) {

          if(property_exists($discount, $prop)) {

            $collection[$prop] = (string)$discount->$prop;

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
