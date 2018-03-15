<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class CustomFields {

    protected $custom;

    public function __construct($data)
    {
        $this->custom = new Collection();
        
        $data = $data->custom_fields;
        
        foreach($data->custom_field as $c) {
            
            $custom = [
                'custom_field_name' => (string)$c->custom_field_name,
                'custom_field_value' => (string)$c->custom_field_value,
                'custom_field_is_hidden' => (string)$c->custom_field_is_hidden
            ];
            
            $this->custom->push($custom);
        }
    }
    
    public function isHidden($name)
    {
        $field = $this->get($name);
        
        if(!is_null($field) && $field['custom_field_is_hidden']) {
            return true;
        }
        
        return false;
    }


    public function get($name = null)
    {

        if(is_null($name)) {
            return $this->custom;
        }

        //find index by name of option
        $item = $this->custom->firstWhere('custom_field_name', $name);

        return (!is_null($item)) ? new Collection($item) : null;

    }
}
