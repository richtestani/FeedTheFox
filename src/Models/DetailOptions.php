<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class DetailOptions implements iModel {

    protected $options;
    protected $hasOptions = true;

    
    public function __construct($processor)
    {

        $options = $processor->get();
        $option= [];
        
        foreach($options as $o) {
            //each collection
            $option[] = $o;
        }

        if(empty($options->all())) {
            $this->hasOptions = false;
        }
        
        $this->options = new Collection($option);

    }
    

    public function get($property = null)
    {
        if( $this->options->count() == 1) {
            return (is_null($property)) ? $this->options : $this->options->get($property);
        } else {
            return (is_null($property)) ? $this->options : $this->options->pluck($property);
        }
        
    }
    
    public function hasOptions()
    {
        return $this->hasOptions;
    }
    
    public function numOptions()
    {
        return $this->options->count();
    }

    
    public function options($property = null)
    {
        return (is_null($property)) ? $this->options : $this->options->get($property);
    }
    
    public function findOption($property, $value = null) {
        
        return $this->options->first(function($index, $el) use ($property, $value) {

            if( $el[$property] == $value ) {
                return $el;
            }
            
        });
    }
    
    public function optionEqualTo($name, $value) {
        return $this->options->filter(function($item) use ($name, $value) {
           return ($item[$name] == $value) ? true : false;
        });
        
    }
    
    public function getAllOptionsNames()
    {
        $item = $this->details->pluck('product_option_name')->filter(function($i) {
            return (!empty($i));
        });
        
        return $item->all();
    }
    
    public function getAllOptionsValues()
    {
        $item = $this->details->pluck('product_option_value')->filter(function($i) {
            return (!empty($i));
        });
        
        return $item->all();
    }
    
    
}