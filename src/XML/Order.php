<?php

namespace RichTestani\FeedTheFox\XML;

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
    
    public function __construct(\SimpleXMLElement $order)
    {
        $order = $order->transaction;
        
        $this->id = (string)$order->id;
        $this->customer_id = (string)$order->customer_id;
        $this->store_id = (string)$order->store_id;
        $this->data_is_fed = (string)$order->data_is_fed;
        $this->is_hidden = (string)$order->is_hidden;
        $this->is_test = (string)$order->is_test;
        $this->transaction_date = (string)$order->transaction_date;
        $this->processor_response = (string)$order->processor_response;
        $this->is_anonymous = (string)$order->is_anonymous;
        $this->minfraud_score = (string)$order->minfraud_score;
        $this->purchase_order = (string)$order->purchase_order;
        
        $this->cc_number_masked = (string)$order->cc_number_masked;
        $this->cc_type = (string)$order->cc_type;
        $this->cc_exp_month = (string)$order->cc_exp_month;
        $this->cc_exp_year = (string)$order->cc_exp_year;
        $this->cc_start_date_month = (string)$order->cc_start_date_month;
        $this->cc_start_date_year = (string)$order->cc_start_date_year;
        $this->cc_issue_number = (string)$order->cc_issue_number;
        
        $this->shipping_first_name = (string)$order->shipping_first_name;
        $this->shipping_last_name = (string)$order->shipping_last_name;
        $this->shipping_company = (string)$order->shipping_company;
        $this->shipping_addtress1 = (string)$order->shipping_address1;
        $this->shipping_address2 = (string)$order->shipping_address2;
        $this->shipping_city =(string)$order->shipping_city;
        $this->shipping_state = (string)$order->shipping_state;
        $this->shipping_postal_code = (string)$order->shipping_postal_code;
        $this->shipping_country = (string)$order->shipping_country;
        $this->shipping_phone = (string)$order->shipping_phone;
        $this->shipto_shipping_service_description = (string)$order->shipto_shipping_service_description;
        
        $this->product_total = (string)$order->product_total;
        $this->tax_total = (string)$order->tax_total;
        $this->shipping_total = (string)$order->shipping_total;
        $this->order_total = (string)$order->order_total;
        
        $this->payment_gateway_type = (string)$order->payment_gateway_type;
        $this->receipt_url = (string)$order->receipt_url;
        $this->taxes = (string)$order->taxes;
        
        $this->status = (string)$order->status;
        
        $this->collection();
        
        
    }
    
    private function collection()
    {
        $order = [];

        foreach (get_object_vars($this) as $name => $prop) {
           $order[$name] = $prop;
        }
        
        $this->order = new Collection($order);
    }
    
    public function get($property = null)
    {
        return (is_null($property)) ? $this->order : $this->$property;
    }
    
}