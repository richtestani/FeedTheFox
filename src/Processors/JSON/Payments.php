<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Payments {

  protected $payments;

  public function __construct($payments, $transaction_id, $customer_id)
  {

    $this->payments = new Collection();

    foreach($payments as $payment)
    {
      $s = new Payment($payment, $transaction_id, $customer_id);
      $this->payments->push($s);
    }

  }

  public function get()
  {
    return $this->payments;
  }

}
