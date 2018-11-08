<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Transaction {

  protected $item;
  protected $category = null;
  protected $options = null;

  protected $properties = [
    'base_price',
    'code',
    'date_created',
    'date_modified',
    'delivery_type',
    'discount_details',
    'discount_name',
    'discount_type',
    'downloadable_url',
    'expires',
    'height',
    'image',
    'is_future_line_item',
    'item_category_uri',
    'length',
    'name',
    'parent_code',
    'price',
    'quantity',
    'quantity_max',
    'quantity_min',
    'shipto',
    'sub_token_url',
    'subscription_end_date',
    'subscription_frequency',
    'subscription_next_transaction_date',
    'subscription_start_date',
    'url',
    'weight',
    'width'
  ];

  public function __construct($item, $transaction_id, $customer_id)
  {

    $i = [];
    foreach($this->properties as $prop) {
      if(in_array($prop, $item)) {
        $i[$prop] = $item[$prop];
      }
    }

    if(isset($item['_embedded']['fx:item_options'])) {
      $this->handleDetailOptions($item['_embedded']['fx:item_options']);
    }

    if(isset($item['_embedded']['fx:item_category'])) {
      $this->handleDetailCategory($item['_embedded']['fx:item_category']);
    }

    $item['transaction_detail_options'] = $this->options;
    $item['item_category'] = $this->category;

    $this->item = new Collection($item);

  }

  public function get()
  {
    return $this->item;
  }

  private function handleDetailOptions($options)
  {

    $this->options = new TransactionOptions($options);

  }

  private function handleDetailCategory($category)
  {
    $this->category = new TransactionCategory($category);
  }

}
