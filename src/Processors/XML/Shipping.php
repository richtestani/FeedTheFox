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

    public function __construct($data)
    {
        $this->shipping = new Collection();
 
        foreach (get_object_vars($this) as $name => $prop) {
            $this->shipping->put($name, (string)$data->$name);
        }
        
    }


    public function get($name = null)
    {
        
        return (is_null($property)) ? $this->shipping : $this->$property;

    }
}
