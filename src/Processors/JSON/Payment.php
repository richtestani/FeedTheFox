<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Payment {

    protected $payment;

    protected $properties = [
      "amount",
      "cc_exp_month",
      "cc_exp_year",
      "cc_number_masked",
      "cc_type",
      "date_created",
      "date_modified",
      "fraud_protection_score",
      "gateway_type",
      "paypal_payer_id",
      "processor_response",
      "processor_response_details",
      "purchase_order",
      "third_party_id" ,
      "type"
    ];

    public function __construct($payment, $transaction_id, $customer_id)
    {

      $p = [];

      foreach($this->properties as $prop) {
        if(array_key_exists($prop, $payment)) {
          $p[$prop] = $payment[$prop];
        }
      }

      $this->payment = new Collection($p);

    }


    public function get()
    {
      return $this->payment;
    }
}
