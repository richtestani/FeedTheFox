<?php

namespace RichTestani\FeedTheFox\Processors\XML;

use Illuminate\Support\Collection;

class Transactions {
    
    protected $transactions = [];
    
    
    public function __construct($data, $transaction_id, $customer_id)
    {
        $this->transactions = new Collection();
        
        $transactions = $data->transaction_details;

        foreach($transactions as $t) {
            
            $this->transactions->push( new Transaction($t->transaction_detail, $transaction_id, $customer_id));
            
        }
    }
    
    public function numberOfTransactions()
    {
        return $this->transactions->count();
    }
    
    public function get()
    {
        return $this->transactions;
    }
    
}