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
        if( $this->details->count() == 1) {
            return (is_null($property)) ? $this->details : $this->details->get($property);
        } else {
            return (is_null($property)) ? $this->details : $this->details->get($property);
        }
        
        
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