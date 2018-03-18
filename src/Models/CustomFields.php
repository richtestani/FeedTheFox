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
        
        if(!is_null($property)) {
            $items = $this->custom->filter(function($item) use ($property) {
                echo $property.'<br>';
                return $item->get($property);
            });
            
            return $items;
        }
        
        return $this->custom;
    }
    
    public function where($name, $value)
    {
        $item = $this->custom->get($name);
        
    }
    
    public function hasCustomFields()
    {
        return ($this->custom->count() > 0) ? true : false;
    }
    
    public function find($property, $value) {
        
        return $this->custom->first(function($index, $el) use ($property, $value) {
            if( $el->get($property) == $value ) {
                return $el;
            }
            
        });
    }
    
        
    public function isHidden($name, $value)
    {
        $field = $this->find($name, $value);
        
        if(!is_null($field) && $field['custom_field_is_hidden']) {
            return true;
        }
        
        return false;
    }
    
    

}