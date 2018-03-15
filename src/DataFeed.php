<?php
	
namespace RichTestani\FeedTheFox;

use RichTestani\FeedTheFox\Processors\DataProcessorFactory;
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
	
	protected $apikey;
	protected $processor;
    
    private $factory;
    
    
    public function __construct($config, $datatype = 'xml')
    {
        
        $this->datatype = strtoupper($datatype);
        
        $this->factory = new DataProcessorFactory;
        
        $config['datatype'] = $this->datatype;
        
        $this->processor = $this->factory->make($config);
        
    }
    
    public function process($data = null)
    {
        $this->processor->process($data);
        
        $foxydata  = $this->processor->get();
        
        foreach($foxydata as $model => $processor) {
            
            $modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $model)));
            $class = __NAMESPACE__."\\Models\\".$modelName;
            
            $this->$model = new $class($processor);
            
        }
        
    }
    
    public function __call($name, $args)
    {
        
        if(property_exists($this, $name)) {
            
            if((count($args) >= 0 && count($args) < 2)) {
                
                $property = $args[0];
                return $this->$name->get($property);
                
            }
            
            
        }

    }

}
?>