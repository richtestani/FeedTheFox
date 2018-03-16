<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Order implements iModel {

    protected $order;

    
    public function __construct($processor)
    {
        
        $this->order = new Collection($processor->get());
        
    }
    

    public function get($property = null)
    {
        
        return (is_null($property)) ? $this->order : $this->order->get($property);
        
    }
    
    public function transactionDeclined()
    {
        
        return (!$this->order->get('status') == 'approved') ? true : false;
        
    }
    
    public function transactionApproved()
    {
        
        return ($this->order->get('status') == 'approved') ? true : false;
        
    }
    
    public function orderIsTest()
    {
        
        return $this->order->get('is_test');
        
    }
    

}