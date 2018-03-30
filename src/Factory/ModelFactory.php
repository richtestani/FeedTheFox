<?php

namespace RichTestani\FeedTheFox\Factory;

use RichTestani\FeedTheFox\Models;

class ModelFactory {
    
    public function make($model, $data = [])
    {
        
        $model = ucwords($model);
        
        return new "Models\\".$model($data);
        
    }
    
}