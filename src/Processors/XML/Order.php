<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Order {
    
    protected $order;
    
    protected $id;
    protected $customer_id;
    protected $store_id;
    protected $data_is_fed;
    protected $is_hidden;
    protected $is_test;
    protected $transaction_date;
    protected $processor_response;
    protected $is_anonymous;
    protected $minfraud_score;
    protected $purchase_order;

    protected $cc_number_masked;
    protected $cc_type;
    protected $cc_exp_month;
    protected $cc_exp_year;
    protected $cc_start_date_month;
    protected $cc_start_date_year;
    protected $cc_issue_number;

    protected $product_total;
    protected $tax_total;
    protected $shipping_total;
    protected $order_total;
    
    protected $shipping_first_name;
    protected $shipping_last_name;
    protected $shipping_company;
    protected $shipping_addtress1;
    protected $shipping_address2;
    protected $shipping_city;
    protected $shipping_state;
    protected $shipping_postal_code;
    protected $shipping_country;
    protected $shipping_phone;
    protected $shipto_shipping_service_description;

    protected $payment_gateway_type;
    protected $receipt_url;
    protected $taxes;

    protected $status;
    
    public function __construct($transaction)
    {
        
        $order = [];
        
        foreach (get_object_vars($this) as $name => $prop) {
           $order[$name] = (string)$transaction->$name;
        }
        
        //setup a collection for easy access
        $this->order = new Collection($order);
        
        
    }
    
    public function get()
    {
        return $this->order;
    }
    
    public function getId()
    {
        return $this->order->get('id');
    }
    
    
}