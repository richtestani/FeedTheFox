<?php

namespace RichTestani\FeedTheFox\Models;

use RichTestani\FeedTheFox\Interfaces\iModel;
use Illuminate\Support\Collection;


class Details implements iModel {

    protected $details;
    protected $options;
    protected $numOptions = 0;
    protected $numItems = 0;
	protected $totalQty = 0;


    public function __construct($processor)
    {

        $details = $processor->get();
        $d = var_export($processor, true);
        $detail = [];
        $options = [];

        foreach($details as $d) {

            $option = $d->pull('transaction_detail_options');
            $option = new DetailOptions($option);

            //count options
            if($option->hasOptions()) {
                $this->numOptions++;
            }

            $options[] = $option;
            $d->put('transaction_detail_options', $option);
            $detail =  $d;
            $this->numItems++;
			$this->totalQty += $d->quantity;

            $this->details[] = new Item($detail);
        }



        $this->options = new Collection($options);

    }


    public function get($property = null)
    {
        return (is_null($property)) ? $this->details : $this->details->get($property);
    }
	
	public function totalQty()
	{
		
	}

    public function numItems()
    {
        return $this->numItems;
    }

    public function numOptions()
    {

        return $this->numOptions;

    }
    public function hasOptions()
    {
        return ($this->numOptions > 0) ? true : false;
    }

    public function options()
    {
        return $this->options;
    }


}
