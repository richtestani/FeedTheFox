<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class CustomField {
    
    protected $custom_field;
    
    protected $custom_field_name;
    protected $custom_field_value;
    protected $custom_field_is_hidden;

    
    
    public function __construct($data)
    {

        $customfield = [];
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
                $customfield[$key] = $value;
            }
        }
        
        $this->custom_field = new Collection($customfield);

    }
    

    
    public function get()
    {
        return $this->custom_field;
    }
}