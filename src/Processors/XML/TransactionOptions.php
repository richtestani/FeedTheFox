<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

/**
**
** TransactionOptions handle each items options
** for example: color or size that might be options
** appended to a product (Transaction)
** This class is a child of Transaction
*/

class TransactionOptions {

    protected $options;

    public function __construct($data)
    {
      $options = [];

      foreach($data->transaction_detail_option as $o) {

          $option = [
              'product_option_name' => (string)$o->product_option_name,
              'product_option_value' => (string)$o->product_option_value,
              'price_mod' => (string)$o->price_mod,
              'weight_mod' => (string)$o->weight_mod
          ];

          $options[] = $option;
      }

      $this->options = new Collection($options);
    }


    public function get()
    {

        return $this->options;

    }

}
