<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Shipping {

    protected $shipping;
    
    protected $shipping_first_name;
    protected $shipping_last_name;
    protected $shipping_company;
    protected $shipping_address1;
    protected $shipping_address2;
    protected $shipping_city;
    protected $shipping_state;
    protected $shipping_postal_code;
    protected $shipping_country;
    protected $shipping_phone;
    protected $shipto_shipping_service_description;

    public function __construct($transaction)
    {
        
        $shipping = [];
 
        foreach (get_object_vars($this) as $name => $prop) {
            $shipping[$name] = (string)$transaction->$name;
        }
        
        $this->shipping = new Collection($shipping);
        
    }


    public function get($name = null)
    {
        
        return $this->shipping;

    }
}
