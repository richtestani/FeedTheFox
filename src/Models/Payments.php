<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Payments implements iModel {

    protected $customer_id;
    protected $amount;
    protected $cc_exp_date;
    protected $cc_exp_year;
    protected $cc_number_masked;
    protected $cc_type;
    protected $date_created;
    protected $date_modified;
    protected $fraud_protection_score;
    protected $gateway_type;
    protected $paypal_payer_id;
    protected $processor_response;
    protected $processor_response_details;
    protected $purchase_order;
    protected $third_party_id;
    protected $type;
    
    public function __construct($processor)
    {
        
        foreach($processor->get() as $payment) {
            $this->payments[] = $payment->get();
        }
        
    }
    

    public function get($property = null)
    {
        return (is_null($property)) ? $this->payments : $this->payments->get($property);
        
    }

}