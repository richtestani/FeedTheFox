<?php

namespace RichTestani\FeedTheFox\Factory;

use RichTestani\FeedTheFox\Models;

class ModelFactory {

  public function make($model, $data = [])
  {

    $model = ucwords($model);

    $ns = "\\RichTestani\\FeedTheFox\Models\\".$model;

    try {

      $class = new $ns($data);
	  return $class;

    } catch (\Exception $e) {

        echo 'Caught exception: ',  $e->getMessage(), "\n";
		exit();

    }

	return null;
	
  }

}
