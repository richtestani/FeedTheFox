<?php

$json_key = 'your_json_secret_key';

//if your site site uses https, you can leave off encryption with JSON
$feedthefox = new DataFeed(['key'=>$json_key, 'encrypted' => false], 'json');

$data = file_get_contents('./example.json');
$feedthefox->process($data);

$order = $feedthefox->order();
$customer = $feedthefox->customer();

$payments = $feedthefox->payments();
$shipping = $feedthefox->shipping();
$details = $feedthefox->details();

echo '<h2>Order</h2>';
echo '<ul>';
echo '<li>Transaction ID: '.$order->get('id').'</li>';
echo '<li>Customer ID: '.$order->get('customer_id').'</li>';
echo '<li>Store ID: '.$order->get('store_id').'</li>';
echo '<li>Data Is Fed: '.$order->get('data_is_fed').'</li>';
echo '<li>Is Hidden: '.$order->get('is_hidden').'</li>';
echo '<li>Is Test: '.$order->get('is_test').'</li>';
echo '<li>Transaction Date: '.$order->get('transaction_date').'</li>';
echo '<li>Is Anon: '.$order->get('is_anonymous').'</li>';
echo '<li>Fraud Protection Score: '.$order->get('fraud_protection_score').'</li>';
echo '<li>Purchase Order: '.$order->get('purchase_order').'</li>';
echo '<li>Product Totak: '.$order->get('product_total').'</li>';
echo '<li>Total Tax: '.$order->get('tax_total').'</li>';
echo '<li>Shipping Total: '.$order->get('shipping_total').'</li>';
echo '<li>Order Total: '.$order->get('order_total').'</li>';
echo '<li>Status: '.$order->get('status').'</li>';
echo '</ul>';

echo '<h2>Customer</h2>';
echo '<ul>';
echo '<li>Customer ID: '.$customer->get('customer_id').'</li>';
echo '<li>Customer IP: '.$customer->get('customer_ip').'</li>';
echo '<li>First Name: '.$customer->get('customer_first_name').'</li>';
echo '<li>Last Name: '.$customer->get('customer_last_name').'</li>';
echo '<li>Company: '.$customer->get('customer_company').'</li>';
echo '<li>Customer Email: '.$customer->get('customer_email').'</li>';
echo '<li>Password Hash: '.$customer->get('customer_password').'</li>';
echo '<li>Pasword Hash Config: '.$customer->get('password_hash_config').'</li>';
echo '<li>Pasword Hash Type: '.$customer->get('password_hash_type').'</li>';
echo '<li>Pasword Salt: '.$customer->get('password_salt').'</li>';
echo '<li>Address 1 : '.$customer->get('customer_address1').'</li>';
echo '<li>Address 2 : '.$customer->get('customer_address').'</li>';
echo '<li>City: '.$customer->get('customer_city').'</li>';
echo '<li>Region: '.$customer->get('customer_state').'</li>';
echo '<li>Postal Code: '.$customer->get('customer_postal_code').'</li>';
echo '<li>Country: '.$customer->get('customer_country').'</li>';
echo '<li>Phone: '.$customer->get('customer_phone').'</li>';
echo '<li>MinFraud Score: '.$customer->get('minfraud_score').'</li>';
echo '<li>Is Anonymous: '.$customer->get('is_anonymous').'</li>';
echo '<li>Tax ID: '.$customer->get('tax_id').'</li>';
echo '<li>Date Created: '.$customer->get('date_created').'</li>';
echo '<li>Date Modified: '.$customer->get('date_modified').'</li>';
echo '<li>Forgot Password: '.$customer->get('forgot_password').'</li>';
echo '<li>Forgot Password Timestamp: '.$customer->get('forgot_password_timestamp').'</li>';
echo '</ul>';

echo '<h2>Shipping</h2>';
echo '<h3>Total Shipments: '.$shipping->totalShipments().'</h3>';
foreach($shipping->get() as $k => $shipment) {

echo '<h5>shipment # '.($k+1).'</h5>';

echo '<ul>';
echo '<li>Customer ID: '.$shipment->get('customer_id').'</li>';
echo '<li>Transaction ID: '.$shipment->get('transaction_id').'</li>';
echo '<li>First Name: '.$shipment->get('first_name').'</li>';
echo '<li>Last Name: '.$shipment->get('last_name').'</li>';
echo '<li>Company: '.$shipment->get('company').'</li>';
echo '<li>Address 1 : '.$shipment->get('address1').'</li>';
echo '<li>Address 2 : '.$shipment->get('address2').'</li>';
echo '<li>City: '.$shipment->get('city').'</li>';
echo '<li>Region: '.$shipment->get('region').'</li>';
echo '<li>Postal Code: '.$shipment->get('postal_code').'</li>';
echo '<li>Country: '.$shipment->get('country').'</li>';
echo '<li>Phone: '.$shipment->get('phone').'</li>';
echo '<li>Date Created: '.$shipment->get('date_created').'</li>';
echo '<li>Date Modified: '.$shipment->get('date_modified').'</li>';
echo '<li>Shipping Service ID: '.$shipment->get('shipping_service_id').'</li>';
echo '<li>Shipping Servie Description: '.$shipment->get('shipping_service_description').'</li>';
echo '<li>Total Price: '.$shipment->get('total_price').'</li>';
echo '<li>Total Shipping: '.$shipment->get('total_shipping').'</li>';
echo '</ul>';

}


echo '<h2>Items/Details</h2>';
echo '<h3>Total Items: '.$details->numItems().'</h3>';


foreach($details->get() as $k => $item) {
  echo '<h5>Item # '.($k+1).'</h5>';
  echo '<ul>';
  echo '<li>Name: '.$item->get('name').'</li>';
  echo ' <li>Code: '.$item->get('code').'</li>';
  echo ' <li>Base Price: '.$item->get('base_price').'</li>';
  echo ' <li>Date Created: '.$item->get('date_created').'</li>';
  echo ' <li>Date Modified: '.$item->get('date_modified').'</li>';
  echo ' <li>Delivery Type: '.$item->get('delivery_type').'</li>';
  echo ' <li>Discount Details: '.$item->get('discount_details').'</li>';
  echo ' <li>Discount Name: '.$item->get('discount_name').'</li>';
  echo ' <li>Download URL: '.$item->get('downloadable_url').'</li>';
  echo ' <li>Expires: '.$item->get('expires').'</li>';
  echo ' <li>Height: '.$item->get('height').'</li>';
  echo ' <li>Image: '.$item->get('image').'</li>';
  echo ' <li>Is Future Line Item: '.$item->get('is_future_line_item').'</li>';
  echo ' <li>Item Category URL: '.$item->get('item_category_uri').'</li>';
  echo ' <li>Length: '.$item->get('length').'</li>';
  echo ' <li>Parent Code: '.$item->get('parent_code').'</li>';
  echo ' <li>Price: '.$item->get('price').'</li>';
  echo ' <li>Quantity: '.$item->get('quantity').'</li>';
  echo ' <li>Quantityt Max: '.$item->get('quantity_max').'</li>';
  echo ' <li>Quantity Min: '.$item->get('quantity_min').'</li>';
  echo ' <li>ShipTo: '.$item->get('shipto').'</li>';
  echo ' <li>Sub Token URL: '.$item->get('sub_token_url').'</li>';
  echo ' <li>Sub End Date: '.$item->get('subscription_end_date').'</li>';
  echo ' <li>Sub Frequency: '.$item->get('subscription_frequency').'</li>';
  echo ' <li>Sub Next Transaction Dat: '.$item->get('subscription_next_transaction_date').'</li>';
  echo ' <li>Sub Start Date: '.$item->get('subscription_start_date').'</li>';
  echo ' <li>URL: '.$item->get('url').'</li>';
  echo ' <li>Weight: '.$item->get('weight').'</li>';
  echo ' <li>Width: '.$item->get('width').'</li>';
  echo '</ul>';
  echo '<h3>Item Options</h3>';
  if($item->hasOptions()) {
    $options = $item->options();

    foreach($options as $option) {
      $optName = $options->get('product_option_name');
    }
  } else {
    echo '<strong>No product options</strong>';
  }

}


echo '<h2>Payments</h2>';
foreach($payments->get() as $payment) {

  echo '<ul>';
  echo '<li>Amount: '.$payment->get('amount').'</li>';
  echo '<li>CC Exp Month: '.$payment->get('cc_exp_month').'</li>';
  echo '<li>CC Exp Year: '.$payment->get('cc_exp_year').'</li>';
  echo '<li>CC Number Masked: '.$payment->get('cc_number_masked').'</li>';
  echo '<li>CC Type: '.$payment->get('cc_type').'</li>';
  echo '<li>Date Created: '.$payment->get('date_created').'</li>';
  echo '<li>Date Modified: '.$payment->get('date_modified').'</li>';
  echo '<li>Fraud Protection Score: '.$payment->get('fraud_protection_score').'</li>';
  echo '<li>Gateway Type: '.$payment->get('gateway_type').'</li>';
  echo '<li>PayPal Id: '.$payment->get('paypal_payer_id').'</li>';
  echo '<li>Processor Response: '.$payment->get('processor_response').'</li>';
  echo '<li>Processor Response Detail: '.$payment->get('processor_response_details').'</li>';
  echo '<li>Purchase Order: '.$payment->get('purchase_order').'</li>';
  echo '<li>Third Party ID: '.$payment->get('third_party_id').'</li>';
  echo '<li>Type: '.$payment->get('type').'</li>';
  echo '</ul>';

}

 ?>
