<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Transactions implements iModel {

    protected $transactions;

    
    public function __construct($data)
    {
        
        $this->transactions = new Collection($data);
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->transactions->all() : $this->transactions->get($property);
        
    }
    
    

}