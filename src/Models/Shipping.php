<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Shipping implements iModel {

    protected $shipping;

    protected $shipments;

    public function __construct($processor)
    {

        $shipping = $processor->get();

        foreach($shipping as $shipment) {
            $this->shipping[] = $shipment->get();
        }

    }


    public function get($property = null)
    {

        return (is_null($property)) ? $this->shipping : $this->shipping->get($property);

    }

    public function hasShippingName($name)
    {
        return (is_null($this->shipping->get('shipto_shipping_service_description'))) ? false : true;
    }

    /**
    * Requires a number
    */
    public function shippingCostIsGreaterThan($amount)
    {

        if(!is_numeric($amount)) {

            trigger_error("shippingCostIsGreaterThan require number");

        }

        $ship_total = $this->shipping->get('shipping_total');

        return ($ship_total > $amount) ? true : false;
    }

    public function shippingCostIsLessThan($amount)
    {

        if(!is_numeric($amount)) {
            trigger_error("shippingCostIsLessThan require number");
        }

        $ship_total = $this->shipping->get('shipping_total');

        return ($ship_total < $amount) ? true : false;
    }

    public function totalShipments()
    {
        return count($this->shipping);
    }

}
