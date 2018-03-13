<?php


use RichTestani\FeedTheFox\DataFeed;

$datafeed = new DataFeed('apikey_2349045utjrdfkl93u4r43tr345');

$datafeed->process($_POST);

$customer = $datafeed->customer();

if($datafeed->order('order_total') > 200) {
    echo 'nice order!';
    //email customer appreciation discount
    $mailer = new Mailer($customer);
}

$details = $datafeed->details();

if( !$datafeed->isCustomer() ) {
    
    //email discount for becoming a member
}


