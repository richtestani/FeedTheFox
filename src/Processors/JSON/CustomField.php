<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class CustomField {

    /**
    * The custom_field collection
    *
    * @var object
    */
    protected $custom_field;

    /**
    * Supported properties for the Models\CustomFields
    *
    */
    protected $properties = [
      'custom_field_name',
      'custom_field_value',
      'custom_field_is_hidden'
    ];


    public function __construct($transaction)
    {

        $customfield = [];

        foreach($this->properties as $prop) {

          $customfield[$prop] = $transaction[$prop];

        }

        $this->custom_field = new Collection($customfield);

    }



    public function get()
    {
        return $this->custom_field;
    }
}
