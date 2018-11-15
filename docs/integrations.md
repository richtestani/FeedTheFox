# Integrations


## Laravel 5

Since it's a composer package, FeedTheFox can work in nearly any project.
Because it uses Laravel's Collection package to handle working with the sets of data,
it fits nicely into any Laravel 5 projects.

```
composer require richtestani/feedthefox
```

Add the configuration to your environment file.

FOXYCART_API = apikey_mygeneratedkey

add a route in your `routes/web.php` file

```
//must be post
Route::post('feedthefox', 'FoxyCartController@feedthefox');
```

Then within laravel artisan or by hand, create the controller

```
php artisan make:controller FoxyCartController
```

Open your new controller and add this after the namespace.

```
use RichTestani\FeedTheFox\DataFeed;
```

Then within the controller, create a method

```

public function feedthefox()
{
    
    $datafeed = new DataFeed(env('FOXYCART_API'));
    $datafeed->process();
    
    $order = $datafeed->order();
    $details = $datafeed->details();
    $custom = $datafeed->custom_fields();
    $shipping = $datafeed->shipping();
    $disounts = $datafeed->discounts();
    
    App\Order::create($order);
    //.... save rest of data

}
```

{% include menu.md %}
