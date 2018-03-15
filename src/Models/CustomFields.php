<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class CustomFields implements iModel {

    protected $custom;

    
    public function __construct($data)
    {
        
        $this->custom = new Collection($data);
        
    }
    

    public function get($property = null)
    {
        
        if(is_null($name)) {
            return $this->custom->all();
        }

        //find index by name of option
        $item = $this->custom->firstWhere('custom_field_name', $name);

        return (!is_null($item)) ? $item : null;
        
    }
    
    

}