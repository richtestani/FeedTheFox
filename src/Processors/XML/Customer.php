<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Customer {
    
    protected $customer;
    
    protected $customer_ip;
    protected $customer_id;
    protected $customer_first_name;
    protected $customer_last_name;
    protected $customer_company;
    protected $customer_email;
    protected $customer_password;
    protected $customer_address1;
    protected $customer_address2;
    protected $customer_city;
    protected $customer_state;
    protected $customer_postal_code;
    protected $customer_country;
    protected $customer_phone;
    protected $minfraud_score;
    protected $is_anonymous;
    
    
    public function __construct($transaction)
    {

        
        
        $customer = [];
        foreach (get_object_vars($this) as $name => $prop) {
           $customer[$name] = (string)$transaction->$name;
        }
        //setup a collection for easy access
        $this->customer = new Collection($customer);

        
    }
    
    public function get() {
        
        return $this->customer;
        
    }
}