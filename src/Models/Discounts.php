<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Discounts implements iModel {

    protected $discounts;

    
    public function __construct($processor)
    {
        
        $this->discounts = new Collection($processor->get());
        
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
    
    

}