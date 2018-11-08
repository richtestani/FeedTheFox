<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;

class Item implements iModel {

    protected $item;

    protected $base_price;
    protected $code;
    protected $date_created;
    protected $date_modified;
    protected $delivery_type;
    protected $discount_details;
    protected $discount_name;
    protected $discount_type;
    protected $downloadable_url;
    protected $expires;
    protected $height;
    protected $image;
    protected $is_future_line_item;
    protected $item_category_uri;
    protected $length;
    protected $name;
    protected $parent_code;
    protected $price;
    protected $quantity;
    protected $quantity_max;
    protected $quantity_min;
    protected $shipto;
    protected $sub_token_url;
    protected $subscription_end_date;
    protected $subscription_frequency;
    protected $subscription_next_transaction_date;
    protected $subscription_start_date;
    protected $url;
    protected $weight;
    protected $width;
    protected $options;
    protected $category;

    public function __construct($collection)
    {
        $this->item = $collection;
        $this->options = $this->item->get('transaction_detail_options');
        $this->category = $this->item->get('item_category');
    }

    public function get($property = null)
    {
        return (is_null($property)) ? $this->item : $this->item->get($property);
    }


    //Format your price
    public function priceFormatted($price = null, $locale = 'en_US')
    {
        setlocale(LC_MONETARY, $locale);
        if(is_null($price)) {
          $number = $this->item->get('product_price');
        } else {
          $number = $price;
        }

        return money_format('%(.2n', $number) . "\n";
    }

    public function options()
    {
        return $this->options;
    }
    
    public function category()
    {
        return $this->category;
    }

    public function hasOptions()
    {
        return (count($this->options->get()) > 0) ? true : false;
    }

    public function optionName()
    {
        //get just the collection
        $options = $this->options->get();

        $names = [];

        foreach($this->options->get() as $t => $opt) {

            if(array_key_exists('product_option_name', $opt)) {
                $names[] = $opt['product_option_name'];
            }
        }

        return $names;

    }

    public function optionValue()
    {
        //get just the collection
        $options = $this->options->get();

        $values = [];

        foreach($this->options->get() as $t => $opt) {

            if(array_key_exists('product_option_value', $opt)) {
                $values[] = $opt['product_option_value'];
            }
        }

        return $values;


    }
    
    public function hasCategoryCode($code)
    {
    
    	$categories = $this->category();
    	//print_r($categories);
    	return ( $categories->get()->get('code') == $code ); 
    }
    
    public function categoryNames()
    {
        //get just the collection
        $category = $this->category->get();

        $names = [];

        foreach($category->get() as $t => $cat) {

            if(array_key_exists('name', $cat)) {
                $names[] = $cat['name'];
            }
        }

        return $names;

    }

}
