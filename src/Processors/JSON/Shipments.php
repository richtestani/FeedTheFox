<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Shipments {

  protected $shipments;

  public function __construct($shipments, $transaction_id, $customer_id)
  {

    $this->shipments = new Collection();

    foreach($shipments as $shipment)
    {
      $s = new Shipment($shipment, $transaction_id, $customer_id);
      $this->shipments->push($s->get());
    }

  }

  public function get()
  {
    return $this->shipments;
  }

}
