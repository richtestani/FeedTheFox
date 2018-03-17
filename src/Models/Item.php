<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;

class Item implements iModel {
    
    protected $item;
    
    public function __construct($collection)
    {
        $this->item = $collection;
        $this->options = $this->item->get('transaction_detail_options');
    }
    
    public function get($property = null)
    {
        return (is_null($property)) ? $this->item : $this->item->get($property);
    }
    
    
    //Format your price
    public function priceFormatted($price, $locale = 'en_US')
    {
        setlocale(LC_MONETARY, $locale);
        $number = $this->item->get('product_price');
        return money_format('%(.2n', $number) . "\n";
    }
    
    public function options()
    {
        return $this->options;
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
    
}