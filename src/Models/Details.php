<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Details implements iModel {

    protected $details;

    
    public function __construct($processor)
    {
        
        $this->details = new Collection($processor->get());
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->details->all() : $this->details->get($property);
        
    }
    
}