<?php

namespace RichTestani\FeedTheFox\DataTypes;

use RichTestani\FeedTheFox\Encryption\rc4crypt;

class XML {
    
    protected $xml;
    protected $key;
    
    public function __construct($key) {
        
        $this->key = $key;
        $decrypted = $this->decrypt($_POST['FoxyData']);
        $this->xml = simplexml_load_string($decrypted, null, LIBXML_NOCDATA);
        
    }
    
    public function get()
    {
        return $this->xml->transactions;
    }
    
    public function decrypt($encrypted)
    {
        return rc4crypt::decrypt($this->key, urldecode($encrypted));
    }
    
    public function encrypt($data)
    {
        $data = rc4crypt::encrypt($this->key, $data);
        return urlencode($data);
    }
    
    protected function process($nodes)
    {
        //$this->transactions = $this->parsed->transactions;
        $this->transactions = $transaction;
        
        
        //Order
        $this->order = new XML\Order($this->transactions);
        
        //Details
        $this->details = new XML\Transactions($this->transactions[0]->transaction->transaction_details, $this->order->get('id'), $this->order->get('customer_id'));
        
        //Customers
        $this->customer = new XML\Customer($this->transactions[0]->transaction);
        
        //Discounts
        $this->discounts = new XML\Discounts($this->transactions[0]->transaction->discounts, $this->order->get('id'), $this->order->get('customer_id'));
    }
    
}