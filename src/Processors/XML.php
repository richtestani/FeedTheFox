<?php

namespace RichTestani\FeedTheFox\Processors;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;
use RichTestani\FeedTheFox\Encryption\rc4crypt;

class XML implements iDataProcessor {
    
    protected $xml;
    
    protected $key;
    
    protected $encrypted = true;
    
    protected $foxydata;
    
    protected $transaction;
    
    public function __construct($config) {
        
        extract($config);
        
        if( !$this->hasKey($config) ) {
            
            die("No key was provided. Please check your FoxyCart documentation for getting an api key");
            
        }
        
        $this->isDataEncrypted($config);
        
        $this->key = $key;
        
    }
    
    public function get()
    {
        return $this->foxydata;
    }
    
    
    /**
        The method doing most of the work.
    */
    public function process($data = null)
    {
        
        if(is_null($data)) {
            
            $data = $_POST;
            
        }
        
        if( !$this->isFoxy($data) ) {
            
            die("This data is not foxy.");
            
        }
        
        //we should be foxy by now
        $data = $data['FoxyData'];
        
        //allowed unexcrypted if you want to test a file
        //otherwise coming from Foxy will be encrypted
        if($this->encrypted) {

            $data = $this->decrypt($data);
            
        }
        
        //use PHP's built in simple xml parser
        $this->xml = simplexml_load_string($data, null, LIBXML_NOCDATA);

        $this->transaction = $this->xml->transactions->transaction;
        
        $this->setData($this->transaction);
        

    }
    
    public function setData($transaction)
    {
        //Parse the XML into logical portions
        $customer       = new XML\Customer($transaction);
        $order          = new XML\Order($transaction);
        $details        = new XML\Transactions($transaction, $order->getId(), $customer->getId());
        $custom         = new XML\CustomFields($transaction);
        $shipping       = new XML\Shipping($transaction);
        $discounts      = new XML\Discounts($transaction, $order->getId(), $customer->getId());
        
        $this->foxydata = [
            'customer'              => $customer,
            'order'                 => $order,
            'details'               => $details,
            'custom_fields'         => $custom,
            'shipping'              => $shipping,
            'discounts'             => $discounts
        ];
    }

    
    public function toString()
    {
        
        return $this->xml->asXML();
        
    }
    
    public function done()
    {
        
        die("foxy");
        
    }
    
    private function customer()
    {
        
        $this->customer = new Models\Customer();
        
    }
    
    private function decrypt($encrypted)
    {
        
        return rc4crypt::decrypt($this->key, urldecode($encrypted));
        
    }
    
    private function encrypt($data)
    {
        
        $data = rc4crypt::encrypt($this->key, $data);
        return urlencode($data);
    }
    
    private function hasKey($config)
    {
        
        if(array_key_exists('key', $config)) {
           return true;
        }
           
           return false;
    }
    
    private function isFoxy($data)
    {
        if(array_key_exists('FoxyData', $data)) {
            return true;
        }
        
        return false;
    }
    
    private function isDataEncrypted($config)
    {
        if(array_key_exists('encrypted', $config)) {
            $this->encrypted = $config['encrypted'];
        }
    }
    
    
}