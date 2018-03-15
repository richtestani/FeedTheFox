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
        
        return (is_null($property)) ? $this->discounts->all() : $this->discounts->get($property);
        
    }
    
    public function hasDiscount()
    {
        
       
        
    }
    
    

}