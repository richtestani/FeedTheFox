<?php

namespace RichTestani\FeedTheFox\Processors;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;
use RichTestani\FeedTheFox\Encryption\rc4crypt;

class XML implements iDataProcessor {
    
    /**
    * The xml string
    *
    * @var string
    */
    protected $xml;
    
    /**
    * The foxy key
    * 
    * @var string
    */
    protected $key;
    
    /**
    * Boolean value to force decryption 
    * 
    * @var boolean
    */
    protected $encrypted = true;
    
    /**
    * The parsed data in an array
    *
    * @var array
    */
    protected $foxydata;
    
    /**
    * The transaction node on the xml document
    *
    * @var object
    */
    protected $transaction;
    
    /**
    *
    * @return void
    */
    public function __construct($config) {
        
        extract($config);
        
        if( !$this->hasKey($config) ) {
            
            die("No key was provided. Please check your FoxyCart documentation for getting an api key");
            
        }
        
        $this->isDataEncrypted($config);
        
        $this->key = $key;
        
    }
    
    /**
    * returns all the data in an array
    *
    * @return void
    */
    public function get()
    {
        return $this->foxydata;
    }
    
    
    /**
    * passes the foxydata through here, and builds the data models
    *
    * @return void
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
    
    /**
    * data setter
    *
    * @return void
    */
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

    /**
    * returns the xml string
    *
    * @return string
    */
    public function toString()
    {
        
        return $this->xml->asXML();
        
    }
    
    /**
    * ends the process
    *
    * @return string
    */
    public function done()
    {
        
        die("foxy");
        
    }
    
    /**
    * decrypt a string using rc4crypt
    *
    * @return string
    */
    private function decrypt($encrypted)
    {
        
        return rc4crypt::decrypt($this->key, urldecode($encrypted));
        
    }
    
    /**
    * decrypt a string using rc4crypt
    *
    * @return string
    */
    private function encrypt($data)
    {
        
        $data = rc4crypt::encrypt($this->key, $data);
        return urlencode($data);
        
    }
    
    /**
    * checks if a key was passed within the config
    *
    * @return boolean
    */
    private function hasKey($config)
    {
        
        if(array_key_exists('key', $config)) {
           return true;
        }
           
           return false;
    }
    
    /**
    * tests if the _POST array has a key named FoxyData
    *
    * @return boolean
    */
    private function isFoxy($data)
    {
        if(array_key_exists('FoxyData', $data)) {
            
            return true;
            
        }
        
        return false;
    }
    
    /**
    * tests if we are configured for an encrypted string
    *
    * @return string
    */
    private function isDataEncrypted($config)
    {
        if(array_key_exists('encrypted', $config)) {
            
            $this->encrypted = $config['encrypted'];
            
        }
    }
    
    
}