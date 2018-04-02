<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class TransactionOptions {

    protected $options;

    protected $properties = [
      'product_option_name' => 'name'
      'product_option_value' => 'value',
      'price_mod' => 'price_mod',
      'weight_mod' => 'weight_mod',
      'date_modified' => 'date_modified',
      'date_created' => 'date_created'
    ];

    public function __construct($options)
    {
        $this->options = new Collection();
        $counter = 0;

        foreach($options as $o) {

            $this->options->push($o);

        }


    }


    public function get()
    {

        return $this->options;

    }

}
