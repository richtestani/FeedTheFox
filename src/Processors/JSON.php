<?php


namespace RichTestani\FeedTheFox\Processors;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;

class JSON implements iDataProcessor {
    
    public function process($data = null)
    {
        
        if(is_null($data)) {
            
            $data = file_get_contents('php://input');
            
        }
        
        $data = json_decode($data, true);
        
        
        if( !$this->isFoxy($data) ) {
            
            trigger_error("This data is not foxy.");
            
        }
        
        $signature = $this->encrypt($data);
        
        if (!hash_equals($signature, $_SERVER['HTTP_FOXY_WEBHOOK_SIGNATURE'])) {
            echo "Signature verification failed - data corrupted";
            http_response_code(500);
            return;
        }
        
        $this->transaction = $data;
        
        $this->setData();
        
        
    }
    
    public function setData()
    {
        //Parse the JSON into logical portions
        $customer = new JSON\Customer($this->transaction);
//        $order = new JSON\Order($data);
//        $details = new JSON\Transactions($data, $order->getId(), $customer->getId());
//        $custom = new JSON\CustomFields($data);
//        $shipping = new JSON\Shipping($data);
//        $discounts = new JSON\Discounts($data, $order->getId(), $customer->getId());
        
        $this->foxydata = [
            'customer'              => $customer,
//            'order'                 => $order,
//            'details'               => $details,
//            'custom_fields'         => $custom,
//            'shipping'              => $shipping,
//            'discounts'             => $discounts
        ];
    }
    
    public function get()
    {
        return $this->foxydata;
    }
    
    
    private function hasKey($config)
    {
        
        if(array_key_exists('key', $config)) {
           return true;
        }
           
           return false;
    }
    
    public function get()
    {
        
    }
    
    private function enrypt($data)
    {
        return hash_hmac('sha256', $data, $this->key);
    }
    
    private function decrypt()
    {
        
    }
    
    private function isFoxy($data)
    {
        return (is_array($data)) ? true : false;
    }
    
    
    
}