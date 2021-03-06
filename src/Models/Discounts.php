<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Discounts implements iModel {

    protected $discounts;
    
    protected $total;
    
    protected $transaction_id;
    
    protected $customer_id;

    
    public function __construct($processor)
    {
        
        $this->discounts = new Collection($processor->get());
        
        $this->transaction_id = $processor->getId('transaction');
        
        $this->customer_id = $processor->getId('customer');
        
        $total = 0;
        
        foreach($this->discounts as $d) {
        	$total += $d->get('amount');
        }
        
        $this->total = number_format($total, 2);
        
    }
    

    public function get($property = null)
    {
    
        
        if( is_null($property) ) {
            
            return $this->discounts;
            
        }
        
        
        return $this->discounts->firstWhere($property);
        
    }
    
    public function hasDiscount()
    {
       
        return ($this->discounts->count() == 0) ? false : true;
       
    }
    
    public function numDiscounts()
    {
        
        return $this->discounts->count();
    }
    
    public function hasCode($code)
    {
        $coupon = $this->discounts->where('code', $code);
        return $coupon;
    }
    
    public function totalDiscountAmount()
    {
    	return $this->total;
    }
    
    public function getId($type = 'transaction')
    {
    	$prop = $type.'_id';
    	return $this->$prop;
    }
    

}