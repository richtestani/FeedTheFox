<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class CustomFields {

    /**
    * Collects all custom_field data
    *
    * @var object
    */
    protected $custom;

    public function __construct($data)
    {
        $this->custom = new Collection();

        $data = $data->custom_fields;

        $custom = [];

        foreach($data->custom_field as $c) {

            $customfields = new CustomField($c);
            $custom[] = $customfields->get();
            
        }

        $this->custom = new Collection($custom);


    }

    /**
    * get the custom fields collection
    *
    */
    public function get()
    {

        return $this->custom;

    }
}
