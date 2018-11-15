<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Discounts {

    protected $discount;

    public function __construct($transaction, $transaction_id, $customer_id)
    {

        $discounts = [];

        foreach($transaction as $discount) {

          $discount = new Discount($discount, $transaction_id, $customer_id);
          $discounts[] = $discount->get();

        }

        $this->discount = new Collection($collection);

    }


    public function get()
    {
        return $this->discount;
    }
}
