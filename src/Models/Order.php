<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Order implements iModel {

    protected $order;

    
    public function __construct($data)
    {
        
        $this->order = new Collection($data);
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->order->all() : $this->order->get($property);
        
    }
    
    public function transactionDeclined()
    {
        return (!$this->order->get('status')) ? true : false;
    }
    
    public function transactionApproved()
    {
        return ($this->order->get('status')) ? true : false;
    }
    
    

}