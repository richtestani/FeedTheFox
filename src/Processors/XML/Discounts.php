<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Discounts {
    
    protected $discounts;
    protected $transaction_id;
    protected $customer_id;
    
    public function __construct($discounts, $transaction_id, $customer_id)
    {

        $this->discounts = new Collection();
        $this->transaction_id = $transaction_id;
        $this->customer_id = $customer_id;
        
        foreach($discounts->discounts as $d) {

            $this->discounts->push(new Discount($d->discount, $this->transaction_id, $this->customer_id));

		}
    }
    
    public function collection()
    {
        return $this->discounts;
    }
    
    public function get($property = null)
    {
        return $this->discounts;
    }
}