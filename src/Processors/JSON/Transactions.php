<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Transactions {

    protected $transactions = [];


    public function __construct($transaction, $transaction_id, $customer_id)
    {

        $transactions = [];

        foreach($transaction as $item) {

          $trans = new Transaction($item, $transaction_id, $customer_id);
          $transactions[] = $trans->get();

        }

        $this->transactions = new Collection($transactions);
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
