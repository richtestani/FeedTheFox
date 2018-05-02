# Testing

FeedTheFox offers a simple built-in testing ground for your feeds.

The XML is a specific format, so it needs to be that same structure. You can grab
an example from FoxyCarts website and save it to a file example.xml.

Create a new file dalled datafeed.php

include the composer autload file, and import RichTestani\FeedTheFox\DataFeed;

```
$config = [
    'key' => 'your-key-in-advanced-settings',
    'encrypted' => false
];
```
By default, were expecting an encryped xml file, but we can use a plain string from a file without dealing with
encryption and decryption.

```
$xml = file_get_contents('example.xml');
$datafeed = new DataFeed($config);
$datafeed->process($xml);
```

Now that we've processed the datafeed, you are free to do whatever you need to.

```
$order = $datafeed->order();
echo $order->get('id');
```


{% include menu.md %}
