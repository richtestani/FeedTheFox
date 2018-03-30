<?php

namespace RichTestani\FeedTheFox\Factory;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;

class DataProcessorFactory {
    
    public function make($config)
    {
        
        switch($config['datatype']) {
                
            case 'xml':
                
                return new RichTestani\FeedTheFox\Processors\XML($config);
                
                break;
                
            case 'json':
                
                return new RichTestani\FeedTheFox\Processors\JSON($config); 
                
                break;
        }
        
    }
}