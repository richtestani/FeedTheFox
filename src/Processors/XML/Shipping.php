<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Shipping {

    protected $shipping;

    protected $properties = [
      'shipping_first_name',
      'shipping_last_name',
      'shipping_company',
      'shipping_address1',
      'shipping_address2',
      'shipping_city',
      'shipping_state',
      'shipping_postal_code',
      'shipping_country',
      'shipping_phone',
      'shipto_shipping_service_description',
      'shipping_total',
    ];


    public function __construct($transaction)
    {

        $shipping = [];

        foreach ($this->properties as $prop) {

            $shipping[$prop] = (string)$transaction->$prop;

        }

        $this->shipping = new Collection($shipping);

    }

    /**
    *
    * @return object
    */
    public function get()
    {

        return $this->shipping;

    }
}
