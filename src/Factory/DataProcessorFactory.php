<?php

namespace RichTestani\FeedTheFox\Factory;

use RichTestani\FeedTheFox\Interfaces\iDataProcessor;
use RichTestani\FeedTheFox\Processors;

class DataProcessorFactory {

    public function make($config)
    {

        switch(strtolower($config['datatype'])) {

            case 'xml':

                return new Processors\XML($config);

                break;

            case 'json':

                return new Processors\JSON($config);

                break;
        }

    }
}
