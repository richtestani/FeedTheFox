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
    
    
    public function get($property)
    {
        
        return (is_null($property)) ? $this->options : $this->options->get($property);
        
    }
    
}