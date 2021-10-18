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
      'custom_field_name' => 'name',
      'custom_field_value' => 'value',
      'custom_field_is_hidden' => 'is_hidden',
      'date_created' => 'date_created',
      'date_modified' => 'date_modified'
    ];


    public function __construct($transaction)
    {

        $customfield = [];

        foreach($this->properties as $prop => $map) {

          $customfield[$prop] = $transaction[$map];

        }

        $this->custom_field = new Collection($customfield);

    }



    public function get($property = null)
    {

		if(in_array($property, array_keys($this->properties))) {
			return $this->custom_field->get($property);
		}
        return $this->custom_field;
    }
}
