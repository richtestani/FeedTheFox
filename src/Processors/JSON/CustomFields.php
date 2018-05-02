<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class CustomFields {

    /**
    * Collects all custom_field data
    *
    * @var object
    */
    protected $custom;

    public function __construct($data, $transaction_id, $customer_id)
    {
        $this->custom = new Collection();

        $custom = [];

        foreach($data as $c) {

            $customfields = new CustomField($c, $transaction_id, $customer_id);
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
