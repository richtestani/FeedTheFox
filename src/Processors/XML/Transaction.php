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
    
    protected $transaction_detail_options;
    
    
    public function __construct($details, $transaction_id, $customer_id) {

        $this->transaction_id = $transaction_id;
        $this->customer_id = $customer_id;
        
        $transaction = [];
        
        $options = $details->transaction_detail_options;
        
        foreach($details as $k => $d) {
            
            
            
            if(property_exists($this, $k)) {
                 
                $this->$k = (string)$d;
                $transaction[$k] = $this->$k;

            }
            
        }
        
        $this->transaction_detail_options = new TransactionOptions($options);

        $transaction['transaction_detail_options'] = $this->transaction_detail_options;
        
        //append ds for convenience
        $transaction['transaction_id'] = $this->transaction_id;
        $transaction['customer_id'] = $this->customer_id;
        
        $this->transaction = new Collection($transaction);

    }

    
    public function get($property = null)
    {
        return $this->transaction;
    }
    
    
}