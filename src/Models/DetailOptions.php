<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class DetailOptions implements iModel {

    protected $options;

    
    public function __construct($processor)
    {

        $options = $processor->get();
        $option= [];
        
        foreach($options as $o) {
            $option[] = $o;
        }
        
        $this->options = new Collection($option);

    }
    

    public function get($property = null)
    {
        if( $this->options->count() == 1) {
            return (is_null($property)) ? $this->options->first() : $this->options->get($property);
        } else {
            return (is_null($property)) ? $this->options : $this->options->pluck($property);
        }
        
    }
    
    public function hasOptions()
    {
        return ($this->options->count() > 0) ? true : false;
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
    
    
    
}