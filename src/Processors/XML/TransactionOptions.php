<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class TransactionOptions {
    
    protected $options;
    
    public function __construct($data)
    {
        $this->options = new Collection();
        
        foreach($data->transaction_detail_option as $o) {
            
            $option = [
                'product_option_name' => (string)$o->product_option_name,
                'product_option_value' => (string)$o->product_option_value,
                'price_mod' => (string)$o->price_mod,
                'weight_mod' => (string)$o->weight_mod
            ];
            
            $this->options->push($option);
        }
    }
    
    
    public function get($name = null)
    {
        
        if(is_null($name)) {
            return $this->options;
        }
        
        //find index by name of option
        $item = $this->options->firstWhere('product_option_name', $name);

        return (!is_null($item)) ? new Collection($item) : null;
        
    }
}