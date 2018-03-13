<?php

namespace RichTestani\FeedTheFox\XML;

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
    protected $is_anonymous;
    
    
    public function __construct($transaction)
    {

        $this->customer_ip              = (string)$transaction->customer_ip;
		$this->customer_id              = (string)$transaction->customer_id;
		$this->customer_first_name      = (string)$transaction->customer_first_name;
		$this->customer_last_name       = (string)$transaction->customer_last_name;
		$this->customer_company         = (string)$transaction->customer_company;
		$this->customer_email           = (string)$transaction->customer_email;
		$this->customer_password        = (string)$transaction->customer_password;
		$this->customer_address1        = (string)$transaction->customer_address1;
		$this->customer_address2        = (string)$transaction->customer_address2;
		$this->customer_city            = (string)$transaction->customer_city;
		$this->customer_state           = (string)$transaction->customer_state;
		$this->customer_postal_code     = (string)$transaction->customer_postal_code;
		$this->customer_country         = (string)$transaction->customer_country;
		$this->customer_phone           = (string)$transaction->customer_phone;
        $this->is_anonymous             = (string)$transaction->is_anonymous;
        $this->minfraud_score           = (string)$transaction->minfraud_score;
        
        //setup a collection for easy access
        $this->collection();
        
    }
    
    public function get($property = null) {
        
        return (is_null($property)) ? $this->customer : $this->$property;
        
    }
    
    private function collection()
    {
        $customer = [
            'customer_id'               => $this->customer_id,
            'customer_ip'               => $this->customer_ip,
            'customer_first_name'       => $this->customer_first_name,
            'customer_last_name'        => $this->customer_last_name,
            'customer_company'          => $this->customer_company,
            'customer_address1'         => $this->customer_address1,
            'customer_address2'         => $this->customer_address2,
            'customer_phone'            => $this->customer_phone,
            'customer_city'             => $this->customer_city,
            'customer_state'            => $this->customer_state,
            'customer_postal_code'      => $this->customer_postal_code,
            'customer_country'          => $this->customer_country,
            'customer_email'            => $this->customer_email
        ];
        
        $this->customer = new Collection($customer);
    }
    
    public function isCustomer()
    {
        return ($this->customer->get('customer_id') > 0) true : false;
    }
    
    public function isGuest()
    {
        return ($this->customer->get('customer_id') == 0) true : false;
    }
}