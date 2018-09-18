<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Shipment implements iModel {

      protected $country;
      protected $shipping_service_id;
      protected $shipping_service_description;
      protected $total_price;
      protected $address1;
      protected $address2;
      protected $city;
      protected $date_created;
      protected $date_modified;
      protected $first_name;
      protected $last_name;
      protected $postal_code;
      protected $region;
      protected $phone;
      protected $company;
      protected $total_shipping;
      protected $transaction_id;
      protected $customer_id;


    public function __construct($processor)
    {

        $shipment = $processor->get();

        foreach($shipment as $prop => $val) {
            echo $prop.' = '.$val.'<br>';
            if(property_exists($this, $prop)) {
                $this->$prop = $val;
            }
        }

    }


    public function get($property = null)
    {
        return (is_null($property)) ? null : $this->$property;

    }


}
