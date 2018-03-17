<?php

//route: '/postprocess/datafeed
//example works with Laravel 5

require_once(__DIR__.'/autoload.php');

use RichTestani\FeedTheFox\DataFeed;
use App\Customer;
use App\Order;
use App\TransactionDetails;

$datafeed = new DataFeed('apikey_2349045utjrdfkl93u4r43tr345');
$datafeed->process($_POST);


$order = $datafeed->order->get();
$customer = $datafeed->customer->get();
$details = $datafeed->details->get();

Customer::create($customer);
Order::create($order);


foreach($details as $key => $record) {
    
    $transaction = [];
    $transaction['id']              = $datafeed->order->get('id');
    $transaction['code']            = $record->get('product_code');
    $transaction['product_name']    = $record->get('product_name');
    $transaction['unit']            = $record->get('product_price');
    
    TransactionDetails::create($transaction);
}
