<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Taxes implements iModel {

    protected $taxes;


    public function __construct($processor)
    {

        $this->taxes = new Collection($processor->get());

    }


    public function get($property = null)
    {

        return (is_null($property)) ? $this->taxes : $this->taxes->get($property);

    }

    
}
