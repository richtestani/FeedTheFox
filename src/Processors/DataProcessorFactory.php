<?php

namespace RichTestani\FeedTheFox\Processors;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;

class DataProcessorFactory {
    
    public function make($config)
    {
        
        extract($config);
        
        $datatype = strtoupper($datatype);
        
        $class = __NAMESPACE__."\\".$datatype;
        
        return new $class($config);
        
    }
}