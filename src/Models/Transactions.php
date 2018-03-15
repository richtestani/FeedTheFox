<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Transactions implements iModel {

    protected $transactions;

    
    public function __construct($processor)
    {
        
        $this->transactions = new Collection($processor->get());
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->transactions->all() : $this->transactions->get($property);
        
    }
    
    

}