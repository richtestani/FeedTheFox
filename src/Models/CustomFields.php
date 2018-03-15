<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class CustomFields implements iModel {

    protected $custom;

    
    public function __construct($processor)
    {
        
        $this->custom = new Collection($processor->get());

    }
    

    public function get($property = null)
    {
        if(is_null($property)) {
            return $this->custom;
        }
        return $this->custom;
    }
    
    public function where($name, $value)
    {
        $item = $this->custom->get($name);
        
    }
    
    public function find($property, $value) {
        
        return $this->custom->first(function($index, $el) use ($property, $value) {

            if( $el[$property] == $value ) {
                return $el;
            }
            
        });
    }
    
        
    public function isHidden($name)
    {
        $field = $this->get($name);
        
        if(!is_null($field) && $field['custom_field_is_hidden']) {
            return true;
        }
        
        return false;
    }
    
    

}