<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Discounts {

    protected $discount;

    public function __construct($transaction, $transaction_id, $customer_id)
    {

        $discounts = [];
        
        $this->transaction_id = $transaction_id;
        
        $this->customer_id = $customer_id;

        foreach($transaction as $discount) {
		  
          $discount = new Discount($discount);
          $discounts[] = $discount->get();

        }

        $this->discount = new Collection($discounts);

    }
    
    public function getId($type = 'transaction')
    {
    	$prop = $type.'_id';
    	return $this->$prop;
    }


    public function get()
    {
        return $this->discount;
    }
}
