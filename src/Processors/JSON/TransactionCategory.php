<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class TransactionCategory {

    protected $category;

    protected $properties = [
      'admin_email',
      'admin_email_template_uri',
      'code',
      'customer_email_template_uri',
      'customs_value',
      'date_created',
      'date_modified',
      'default_length_unit',
      'default_weight',
      'default_weight_unit',
      'discount_details',
      'discount_name',
      'discount_type',
      'handling_fee',
      'handling_fee_minimum',
      'handling_fee_percentage',
      'handling_fee_type',
      'item_delivery_type',
      'max_downloads_per_customer',
      'max_downloads_time_period',
      'name',
      'send_admin_email',
      'send_customer_email',
      'shipping_flat_rate',
      'shipping_flat_rate_type'
    ];

    public function __construct($category)
    {

        $c = [];

        foreach($this->properties as $prop) {

            if(in_array($prop, $category)) {
              $c[$prop] = $category[$prop];
            }
        }

        $this->category = new Collection($c);


    }


    public function get()
    {

        return $this->category;

    }

}
