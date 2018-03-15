<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Discounts {
    
    protected $discounts;
    protected $transaction_id;
    protected $customer_id;
    
    public function __construct($transaction, $transaction_id, $customer_id)
    {

        
        $this->transaction_id = $transaction_id;
        
        $this->customer_id = $customer_id;
        
        $discounts = [];
        
        foreach($transaction->discounts as $d) {
            
            $discount = new Discount($d->discount, $this->transaction_id, $this->customer_id);
            $discounts[] = $discount->get();

		}
        
        $this->discounts = new Collection($discounts);
    }
    
    public function get()
    {
        return $this->discounts;
    }
}