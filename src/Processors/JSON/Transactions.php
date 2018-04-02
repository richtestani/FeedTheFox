<?php

namespace RichTestani\FeedTheFox\Processors\JSON;

use Illuminate\Support\Collection;

class Transactions {

    protected $transactions = [];


    public function __construct($transaction, $transaction_id, $customer_id)
    {

        $transactions = [];

        foreach($transaction as $t) {

            foreach($t as $detail) {

                $trans = new Transaction($detail, $transaction_id, $customer_id);
                $transactions[] = $trans->get();

            }

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
