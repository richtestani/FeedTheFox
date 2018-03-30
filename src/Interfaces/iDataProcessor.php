<?php

namespace RichTestani\FeedTheFox\Interfaces;

interface iDataProcessor {
    
    public function process($data = null);
    
    public function get();
    
    public function toString();
    
    
}