<?php
	
namespace RichTestani\FeedTheFox;

/**
    The main Datafeed class which helps generate individual collections of data,
    for the FeedTheFox package.
    
    This rpackage requires composer to install,
    and will require the rc4crpyt & laravel collection libraries.
    
    Currently, this library is designed with the XML implementation
    of FoxyCarts datafeed, but may be updated for JSON support.s
*/

use RichTestani\FeedTheFox\Encryption\rc4crypt;
use RichTestani\FeedTheFox\XML;

class DataFeed {
	
	protected $apikey;
	protected $endpoint;
	protected $response;
	protected $parser;
    
    protected $error;
    
    protected $transactions;
    protected $order;
    protected $customer;
	
	public function __construct($key)
	{
        $this->apikey = $key;
	}
    
    public function decrypt($encrypted)
    {
        return rc4crypt::decrypt($this->apikey, urldecode($encrypted));
    }
    
    public function encrypt($data)
    {
        $data = rc4crypt::encrypt($this->apikey, $data);
        return urlencode($data);
    }
    
    public function process($xml)
    {
        
        $decrypted = $this->decrypt($xml['FoxyData']);

        $this->parser = simplexml_load_string($decrypted, null, LIBXML_NOCDATA);
        
        $this->transactions = $this->parser->transactions;
        
        //Order
        $this->order = new XML\Order($this->transactions);
        
        //Details
        $this->details = new XML\Transactions($this->transactions[0]->transaction->transaction_details, $this->order->get('id'), $this->order->get('customer_id'));
        
        //Customers
        $this->customer = new XML\Customer($this->transactions[0]->transaction);
        
        //Discounts
        $this->discounts = new XML\Discounts($this->transactions[0]->transaction->discounts, $this->order->get('id'), $this->order->get('customer_id'));
    }
    
    
    public function isFoxy($data)
    {
        if(!array_key_exists('FoxyData', $data)) {
            $this->error = 'FoxyData not present';
            return false;
        }
        
        return true;
    }
    
    /**
    ** Customer Methods
    */
    
    public function isCustomer()
    {
        return $this->customer->isCustomer();
    }
    
    public function isGuest()
    {
        return $this->customer->isGuest();
    }
    
    /**
    ** Discount Methods
    */
    public function hasDiscounts()
    {
        return ($this->discounts->get()->count() > 0) ? true : false;
    }
    
    
    /**
        Datafeed Collections
        ======================
        Order
            -- Collects the basics of an order
            
        Customer
            -- Collects just the customer details
            
        Details
            -- Collects transaction details and transation option details
        
        Discounts
            -- Collects discount details
    */
    
    public function customer($property = null)
    {
        return $this->customer->get($property);
    }
    
    public function order($property = null)
    {
        return $this->order->get($property);
    }
    
    public function details()
    {
        return $this->details->get();
    }
    
    public function discounts()
    {
        return $this->discounts->get();
    }
    
    public function getError()
    {
        return $this->error;
    }
	
}
?>