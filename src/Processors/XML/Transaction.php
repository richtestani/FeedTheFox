<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Transaction {

    protected $transaction;

    protected $properties = [
       'id',
       'transaction_date',
       'product_name',
       'product_price',
       'product_quantity',
       'product_weight',
       'product_code',
       'parent_code',
       'image',
       'url',
       'length',
       'width',
       'height',
       'expires',
       'sub_token_url',
       'subscription_frequency',
       'subscription_startdate',
       'subscription_nextdate',
       'subscription_enddate',
       'is_future_line_item',
       'shipto',
       'category_description',
       'category_code',
       'product_delivery_type',
       'transaction_detail_options',
    ];


    public function __construct($details, $transaction_id, $customer_id) {

        $this->transaction_id = $transaction_id;
        $this->customer_id = $customer_id;

        $transaction = [];

        foreach($this->properties as $prop) {

          if(!is_object((string)$details->$prop)) {
            $transaction[$prop] = (string)$details->$prop;
          }

        }

        $this->handleDetailOptions($details->transaction_detail_options);
        $transaction['transaction_detail_options'] = $this->transaction_detail_options;

        $transaction['transaction_id'] = $this->transaction_id;
        $transaction['customer_id'] = $this->customer_id;

        $this->transaction = new Collection($transaction);

    }

    private function handleDetailOptions($options)
    {

      $this->transaction_detail_options = new TransactionOptions($options);

    }


    public function get()
    {
        return $this->transaction;
    }


}
