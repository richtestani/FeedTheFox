<?php

namespace RichTestani\FeedTheFox;

use RichTestani\FeedTheFox\Factory\DataProcessorFactory;
use RichTestani\FeedTheFox\Factory\ModelFactory;
use RichTestani\FeedTheFox\Models;

/**
*    The main Datafeed class which helps generate individual collections of data,
*    for the FeedTheFox package.
*
*    This rpackage requires composer to install,
*    and will require the rc4crpyt & laravel collection libraries.
*
*    Currently, this library is designed with the XML implementation
*    of FoxyCarts datafeed, but may be updated for JSON support.
*/

class DataFeed {

    /**
    * The FoxyCart api key in your advanced settings
    * (Recently a version within your integration settings)
    *
    * @var string
    */
	protected $apikey;

    /**
    * The processor to handle your transaction data
    *
    * @var object
    */
	protected $processor;

    /**
    * @var array
    */
    protected $models = [];

    /*
    * The processor factory
    *
    * @var object
    */
    private $factory;

    /**
    * Build up the processor
    *
    * @return void
    */
    public function __construct($config, $datatype = 'xml')
    {

        if(!is_array($config)) {

            $key = $config;
            $config = [];
            $config['key'] = $config;

        }

        $this->datatype = strtoupper($datatype);

        $this->setFactory();

        $config['datatype'] = $this->datatype;

        $this->processor = $this->factory->make($config);

    }

    /**
    * Run the processor
    *
    * @return void
    */
    public function process($data = null)
    {

        $this->processor->process($data);

        $foxydata  = $this->processor->get();

        $this->parseData($foxydata);

    }

    /**
    * Send back a string representation of the entire datafeed
    *
    * @return string
    */
    public function toString()
    {

        return $this->processor->toString();

    }


    /**
    * Handle getting various nodes of he data feed
    *
    * @return mixed
    */
    public function __call($name, $args)
    {


        if(property_exists($this, $name)) {

            if((count($args) >= 1 && count($args) < 2)) {

                $property = $args[0];
                return $this->$name->get($property);

            }

        }

        //lowercase slug to studly case
        $model = trim(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));

        if(!is_null($this->models) && in_array($model, $this->models)) {

            return $this->$name;

        } else {

            $this->processor->$name($args);

        }

    }

    /**
    * Sets the return data into model objects
    *
    * @return void
    */
    private function parseData($foxydata)
    {

        $modelFactory = new ModelFactory();

        foreach($foxydata as $model => $processor) {

            $modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $model)));

            $this->$model = $modelFactory->make($modelName, $processor);
            $this->models[] = $modelName;

        }

    }

    /**
    * Setup the factory
    *
    * @return void
    */
    public function setFactory()
    {

        $this->factory = new DataProcessorFactory;

    }

		public function done()
		{
			$this->processor->done();
		}



}
?>
