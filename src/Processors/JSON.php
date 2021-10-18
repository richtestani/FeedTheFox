<?php


namespace RichTestani\FeedTheFox\Processors;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;

class JSON implements iDataProcessor {

    /**
    * The json formatted string
    *
    * @var string
    */
    protected $json;

    /**
    * The foxy key
    *
    * @var string
    */
    protected $key;

    /**
    * Boolean value to force decryption
    *
    * @var boolean
    */
    protected $encrypted = false;

    /**
    * Boolean value to force decryption
    *
    * @var boolean
    */
    protected $signatureMatch = false;

    /**
    * The parsed data in an array
    *
    * @var array
    */
    protected $foxydata;

    /**
    * The transaction node on the json file
    *
    * @var object
    */
    protected $transaction;

    public function __construct($config)
    {
      extract($config);

      if( !$this->hasKey($config) ) {

          die("No key was provided. Please check your FoxyCart documentation for getting an api key");

      }

      $this->isDataEncrypted($config);

      $this->key = $key;
    }

    public function process($data = null)
    {

        if(is_null($data)) {

            $data = file_get_contents('php://input');

        }

        if( isset($_SERVER['HTTPS'] ) ) {

           //came over https, no encryption involved
          $transaction = json_decode($data, true);

        } else {
        
          //standatd http connection will return encrypted message
          $transaction = $this-decrypt($data);
          //match signature

        }

        $this->transaction = $transaction;

        $this->setData();


    }

    public function setData()
    {
        //Parse the JSON into logical portions

        $custom_fields = (isset($this->transaction['_embedded']['fx:custom_fields'])) ? $this->transaction['_embedded']['fx:custom_fields'] : [];
		
        $applied_taxes = (isset($this->transaction['_embedded']['fx:applied_taxes'])) ? $this->transaction['_embedded']['fx:applied_taxes'] : [];
        $discounts = (isset($this->transaction['_embedded']['fx:discounts'])) ? $this->transaction['_embedded']['fx:discounts'] : []; 

        $customer = new JSON\Customer($this->transaction);
        $order = new JSON\Order($this->transaction, $customer->getId());
        $details = new JSON\Transactions($this->transaction['_embedded']['fx:items'], $order->getId(), $customer->getId());
		
        $custom = new JSON\CustomFields($custom_fields, $order->getId(), $customer->getId());
        $shipping = new JSON\Shipments($this->transaction['_embedded']['fx:shipments'], $order->getId(), $customer->getId());
        $taxes = new JSON\Taxes($applied_taxes, $order->getId(), $customer->getId());
        $discounts = new JSON\Discounts($discounts, $order->getId(), $customer->getId());
        $payments = new JSON\Payments($this->transaction['_embedded']['fx:payments'], $order->getId(), $customer->getId());


        $this->foxydata = [
            'customer'              => $customer,
            'order'                 => $order,
            'details'               => $details,
            'custom_fields'         => $custom,
            'shipping'              => $shipping,
            'discounts'             => $discounts,
            'taxes'                 => $taxes,
            'payments'              => $payments
        ];
    }

    public function get()
    {
        return $this->foxydata;
    }

    public function toString()
    {

      return json_encode($this->foxydata);

    }
    public function forceSignatureMatch()
    {
      $this->signatureMatch = true;
    }

    private function hasKey($config)
    {

        if(array_key_exists('key', $config)) {

           return true;

        }

        return false;
    }

    private function encrypt($data)
    {
        return hash_hmac('sha256', $data, $this->key);
    }

    //https://wiki.foxycart.com/v/2.0/webhooks
    private function decrypt($data = null)
    {
      if(is_null($data)) {
        http_response_code(500);
        return;
      }

      $parts = explode(':', $data);
      $mac = $parts[0];
      $iv = $parts[1];
      $data = $parts[2];

      $calc_mac = hash('sha256', "$iv:$data");

      if (hash_equals($calc_mac, $mac)) {
          $iv = hex2bin($iv);
          $key = hex2bin(hash('sha256', FOXY_WEBHOOK_ENCRYPTION_KEY));

          if ($data = openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv)) {
              $parsedData = json_decode($data, true);
          } else {
              while ($msg = openssl_error_string()) {
                  echo("Openssl error: " . $msg);
              }
              http_response_code(500);
              return;
          }
      } else {
          // Encrypted data corrupted
          echo("Encrypted data corrupted");
          http_response_code(500);
          return;
      }

    }

    private function isFoxy($data)
    {
        return (is_array($data)) ? true : false;
    }

    /**
    * tests if we are configured for an encrypted string
    *
    * @return string
    */
    private function isDataEncrypted($config)
    {
        if(array_key_exists('encrypted', $config)) {

            $this->encrypted = $config['encrypted'];

        }
    }

    public function done() {
      return;
    }

}
