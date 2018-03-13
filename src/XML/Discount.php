<?php

namespace RichTestani\FeedTheFox\XML;

use Illuminate\Support\Collection;

class Discount {
    
    protected $discount;
    
    protected $code;
    protected $name;
    protected $amount;
    protected $display;
    protected $coupon_display_type;
    protected $coupon_discount_details;
    protected $transaction_id;
    protected $customer_id;
    
    public function __construct($discount, $transaction_id, $customer_id)
    {
        
        $discount = $discount->discount;
        
        $this->code                             = (string)$discount->code;
        $this->name                             = (string)$discount->name;
        $this->amount                           = (string)$discount->amount;
        $this->display                          = (string)$discount->display;
        $this->coupon_discount_type             = (string)$discount->coupon_discount_type;
        $this->coupon_discount_details          = (string)$discount->coupon_discount_details;
        $this->transaction_id                   = $transaction_id;
        $this->customer_id                      = $customer_id;
        
        $this->collection();

    }
    
    public function collection()
    {
        $discount = [
				'code'                      => $this->code,
				'name'                      => $this->name,
				'amount'                    => $this->amount,
				'display'                   => $this->display,
				'coupon_discount_type'      => $this->coupon_discount_type,
				'coupon_discount_details'   => $this->coupon_discount_details,
				'transaction_id'            => $this->transaction_id,
				'customer_id'               => $this->customer_id
			];
        
        $this->discount = new Collection($discount);
    }
    
    public function get($property = null)
    {
        return (is_null($property)) ? $this->collection() : $this->$property;
    }
}