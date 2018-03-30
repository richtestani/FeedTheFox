<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

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

        $data = $transaction['fx:customer'];
        $shipment = $transaction['fx:shipments'];
        
        $customer['customer_ip']                  = $transaction['customer_ip'];
        $customer['customer_id']                  = $data['id'];
        $customer['customer_first_name']          = $data['first_name'];
        $customer['customer_last_name']           = $data['first_name'];
        $customer['customer_company']             = $shipment['company'];
        $customre['customer_email']               = $data['customer_email'];
        $customre['customer_password']            = null;
        $customer['customer_address1']            = $shipment['address1'];
        $customer['customer_address2']            = $shipment['address2'];
        $customer['customer_city']                = $shipment['city'];
        $customer['region']                       = $shipment['region'];
        $customer['customer_postal_code']         = $shipment['postal_code'];
        $customer['customer_country']             = $shipment['country'];
        $customer['customer_phone']               = $data['phone'];
        $customer['minfraud_score']               = null;
        $customer['is_anonymous']                 = $data['is_anonymous'];
        
        $this->customer = new Collcetion($customer);
        
    }
    
    public function get() {
        
        return $this->customer;
        
    }
    
    public function getId()
    {
        return $this->customer->get('customer_id');
    }
}