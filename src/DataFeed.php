<?php
	
namespace RichTestani\FeedTheFox;

use RichTestani\FeedTheFox\DataTypes;

/**
    The main Datafeed class which helps generate individual collections of data,
    for the FeedTheFox package.
    
    This rpackage requires composer to install,
    and will require the rc4crpyt & laravel collection libraries.
    
    Currently, this library is designed with the XML implementation
    of FoxyCarts datafeed, but may be updated for JSON support.
*/

class DataFeed {
	
	protected $apikey;
	protected $endpoint;
	protected $response;
	protected $parse;
    protected $type;
    
    protected $error = null;
    
    protected $transactions;
    protected $order;
    protected $customer;
	protected $shipping;
    protected $custom;
    
    protected $datatypes = ['XML', 'JSON'];
    protected $nodes = ['Customers', 'Order', 'Transactions', 'Discounts', 'Shipping', 'CustomFields'];
    
	public function __construct($config)
	{
        
        extract($config);
        $this->apikey = $key;
        $this->type = 'XML';

	}
    
    public function setDataType($type)
    {
        if(!in_array($type, $this->datatypes)) {
            trigger_error($type . ' : data type not supported');
        }
        
        $this->type = $type;
    }
    
    public function addNode($name)
    {
        $this->nodes[] = $name;
    }
    
    
    
    public function process()
    {
        
        $class = "RichTestani\\FeedTheFox\\DataTypes\\".$this->type;
        
        $datatype = new $class($this->apikey);
        
        $datatype->process($this->nodes);
        
        
        
        
        //Custom Fields
        
        //Shipping

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
    
    public function discounts($name = null)
    {
        return $this->discounts->get($name);
    }
    
    public function custom($name = null)
    {
        return $this->custom->get($name);
    }
    
    public function getError()
    {
        return $this->error;
    }
	
}
?>