<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class CustomFields {

    protected $custom;

    public function __construct($data)
    {
        $this->custom = new Collection();
        
        $data = $data->custom_fields;
        
        $custom = [];
        
        foreach($data->custom_field as $c) {
            
            $fields = [
                'custom_field_name' => (string)$c->custom_field_name,
                'custom_field_value' => (string)$c->custom_field_value,
                'custom_field_is_hidden' => (string)$c->custom_field_is_hidden
            ];
            
            $customfields = new CustomField($fields);
            $custom[] = $customfields->get();
        }
        
        $this->custom = new Collection($custom);
        
        
    }


    public function get($name = null)
    {

        return $this->custom;

    }
}
