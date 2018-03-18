# Integrations


## Laravel 5

Since it's a composer package, FeedTheFox can work in nearly any project.
Because it uses Laravel's Collection package to handle working with the sets of data,
it fits nicely into Laravel 5 projects.

```
composer require richtestani/feedthefox
```

Add the configuration to your environment file.

FOXYCART_API = apikey_mygeneratedkey

Because the datafeed doesn't really require any output to a user, it
should be fed into a request without too much overhead or output.

add a route in your `routes/web.php` file

```
Route::post('feedthefox', 'FoxyCartController@feedthefox');
```

then within laravel artisan or by hand, create the controller

```
php artisan make:controller FoxyCartController
```

Open your new controller and add this after the namespace.

```
use RichTestani\FeedTheFox\DataFeed;
```

The in the controller, create a method

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
