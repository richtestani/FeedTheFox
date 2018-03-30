<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;


class Customer {

    /**
    * The customer collection
    *
    * @var object
    */
    protected $customer;

    /**
    * Supported properties for the Models\Customers
    *
    * @var array
    */
    protected $properties = [
        'customer_ip',
        'customer_id',
        'customer_first_name',
        'customer_last_name',
        'customer_company',
        'customer_email',
        'customer_address1',
        'cusotmer_address2',
        'customer_password',
        'customer_city',
        'customer_state',
        'customer_postal_code',
        'customer_country',
        'customer_phone',
        'minfraud_score',
        'is_anonymous'
    ];


    public function __construct($transaction)
    {

        $customer = [];

        foreach ($this->properties as $prop) {

           $customer[$prop] = (string)$transaction->$prop;

        }

        $this->customer = new Collection($customer);

    }

    public function get() {

        return $this->customer;

    }

    public function getId()
    {
        return $this->customer->get('customer_id');
    }
}
