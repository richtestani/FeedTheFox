<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Customer implements iModel {

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
    protected $is_anonymous;
    
    public function __construct($processor)
    {
        
        $this->customer = new Collection($processor->get());
        
    }
    

    public function get($property = null)
    {

        return (is_null($property)) ? $this->customer : $this->customer->get($property);
        
    }
    
    public function isGuest()
    {
        
        return ($this->customer->get('customer_id') != 0);
        
    }
    
    

}