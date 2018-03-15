<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Shipping implements iModel {

    protected $shipping;

    
    public function __construct($data)
    {
        
        $this->shipping = new Collection($data);
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->shipping : $this->$property;
        
    }
    
}