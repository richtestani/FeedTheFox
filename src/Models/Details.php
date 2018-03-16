<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Details implements iModel {

    protected $details;
    protected $options;

    
    public function __construct($processor)
    {
        
        $details = $processor->get();
        $d = var_export($processor, true);
        file_put_contents(__DIR__.'/details.txt', $d);
        $detail = [];
        $options = [];
        
        foreach($details as $d) {
            
            $option = $d->pull('transaction_detail_options');
            $option = new DetailOptions($option);
            $options[] = $option;
            $d->put('transaction_detail_options', $option);
            $detail[] =  $d;

        }
        
        $this->details = new Collection($detail);
        $this->options = $options;

    }
    

    public function get($property = null)
    {
        return (is_null($property)) ? $this->details : $this->details->get($property);
    }
    
    public function hasOptions()
    {
        return (count($this->options) > 0) ? true : false; 
    }
    
    public function options()
    {
        return $this->options;
    }
    
    public function getAllValuesByProperty($property)
    {
        return $this->details->find(function($index, $el) use ($property) {
            return (is_array($property)) ? $this->details->only($property) : $this->details->pluck($property);
        });
    }
    
    
}