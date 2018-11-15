<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Discount {

    protected $discount;
    
    protected $transaction_id;
    
    protected $customer_id;

    protected $properties = [
      'code' => 'code',
      'name' => 'name',
      'amount' => 'amount',
      'display' => 'display',
      'coupon_display_type' => '',
      'coupon_discount_details' => 'coupon_discount_details'
    ];


    public function __construct($discount, $transaction_id, $customer_id)
    {

        $collection = [];
        
        $this->transaction_id = $transaction_id;
        
        $this->customer_id = $customer_id;

        foreach($this->properties as $prop => $d) {

          if(array_key_exists($d, $discount)) {

            $collection[$prop] = $discount[$prop];

          }

        }


        $this->discount = new Collection($collection);

    }


    public function get()
    {
        return $this->discount;
    }
}
