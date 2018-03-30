<?php
	
namespace RichTestani\FeedTheFox;

use RichTestani\FeedTheFox\Factory\DataProcessorFactory;
use RichTestani\FeedTheFox\Models;

/**
    The main Datafeed class which helps generate individual collections of data,
    for the FeedTheFox package.
    
    This rpackage requires composer to install,
    and will require the rc4crpyt & laravel collection libraries.
    
    Currently, this library is designed with the XML implementation
    of FoxyCarts datafeed, but may be updated for JSON support.
*/

class DataFeed {
	
    /*
    @var string
    */
	protected $apikey;
    
    /*
    @var object
    */
	protected $processor;
    
    /*
    @var array
    */
    protected $models;
    
    /*
    @var object
    */
    private $factory;
    
    
    public function __construct($config, $datatype = 'xml')
    {
        
        if(!is_array($config)) {
            
            $config['key'] = $config;
            
        }
        
        $this->datatype = strtoupper($datatype);
        
        $this->setFactory();
        
        $config['datatype'] = $this->datatype;
        
        $this->processor = $this->factory->make($config);
        
    }
    
    /*
    Run the processor
    */
    public function process($data = null)
    {
        
        $this->processor->process($data);
        
        $foxydata  = $this->processor->get();
        
        $this->parseData($foxydata);
        
    }
    
    public function toString()
    {
        
        return $this->processor->toString();
        
    }
    
    
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
        
        if(in_array($model, $this->models)) {

            return $this->$name;
            
        }

    }
    
    private function parseData($foxydata)
    {
        
        $modelFactory = new ModelFactory();
        
        foreach($foxydata as $model => $processor) {
            
            $modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $model)));
            
            $this->$model = $modelFactory->make($modelName, $processor)
            $this->models[] = $modelName;
            
        }
        
    }
    
    public function setFactory()
    {
        
        $this->factory = new DataProcessorFactory;
        
    }

}
?>