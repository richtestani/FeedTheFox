<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Transaction {
    
    protected $transaction;
    
    protected $id;
    protected $transaction_date;
    
    protected $product_name;
    protected $product_price;
    protected $product_quantity;
    protected $product_weight;
    protected $product_code;
    protected $parent_code;
    protected $image;
    protected $url;
    protected $length;
    protected $width;
    protected $height;
    protected $expires;
    
    protected $sub_token_url;
    protected $subscription_frequency;
    protected $subscription_startdate;
    protected $subscription_nextdate;
    protected $subscription_enddate;
    
    protected $is_future_line_item;
    protected $shipto;
    protected $category_description;
    protected $category_code;
    protected $product_delivery_type;
    
    protected $transaction_detail_options = [];
    
    
    public function __construct($data, $transaction_id, $customer_id) {
        
        $transaction = $data[0];
        
        $this->transaction_id = $transaction_id;
        $this->customer_id = $customer_id;
        
        foreach($transaction as $k => $d) {
            
            if(property_exists($this, $k)) {
                $this->$k = (string)$d;
            }
            
        }
        
        $this->transaction_detail_options = new TransactionOptions($transaction->transaction_detail_options);
        
        $this->collection();

    }
    
    public function collection()
    {
        $transaction = [];
        
        foreach (get_object_vars($this) as $name => $prop) {

           if(!is_object($prop)) {
               $transaction[$name] = (string)$prop;
           } else {
               $transaction[$name] = $prop;
           }
            
        }
        
        $transactions['transaction_id'] = $this->transaction_id;
        $transactions['customer_id'] = $this->customer_id;
        
        
        $this->transaction = new Collection($transaction);
    }
    
    public function options()
    {
        
    }
    
    public function get($property = null)
    {
        return (is_null($property)) ? $this->transaction : $this->$property;
    }
    
    
}