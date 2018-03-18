# Custom Fields

You can get custom field data from accessing the `custom_fields` property. This is a nested array of Collection objects.

```
$custom = $datafeed->custom_fields->get();
```

Or you can get the model itself

```
$custom = $datafeed->custom_fields();
```

From each you can loop through the array values

```
$custom = $datafeed->custom_fields->get();
foreach($custom as $c) {
    //return all custom_field_names
    echo $c->get('custom_field_names');
    echo $c->get('custom_field_value');
}

$custom = $datafeed->custom_fields();
foreach($custom->get() as $c) {
    //return all custom_field_names
    if()
    echo $c->get('custom_field_names');
    echo $c->get('custom_field_value');
}

//return collection
$item = $custom->find('custom_field_name', 'my-value');
if($item->get('custom_field_value') == 'yes') {
    //do something
}

```

Both versions produce a nested array to loop thorugh.

If you need a specific name/value pair, you can use the find method.

```
find($property, $value)

$found = $custom->find('custom_field_name', 'name_of_field');
```
This method returns the entire set of name/values as a collection.

If you use the get method on just a single key name, all names in the transaction will be returned.
For example:

```
<!-- xml snippet -->
<custom_fields>
    <custom_field>
        <custom_field_name>note</custom_field_name>
        <custom_field_value>please send this to me fast!</custom_field_value>
        <custom_field_is_hidden>0</custom_field_is_hidden>
    </custom_field>
    <custom_field>
        <custom_field_name>gift wrap</custom_field_name>
        <custom_field_value>1</custom_field_value>
        <custom_field_is_hidden>0</custom_field_is_hidden>
    </custom_field>
</custom_fields>
<!-- end of snippet -->
```

Here we are going to have 2 sets of custom field name/values.
When I ask for the field `custom_field_name`

I will get both `note` and `gift wrap` returned as a collection.

```
isHidden($name, $value)
````
Returns true or false if name, value has a hidden value of 1
    