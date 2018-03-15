<?php


use RichTestani\FeedTheFox\DataFeed;

$datafeed = new DataFeed('apikey_2349045utjrdfkl93u4r43tr345');
$datafeed->process();

$customer = $datafeed->customer();


