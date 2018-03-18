# Item

retrieve any of these properties through the get method.

* id
* transaction_date

* product_name
* product_price
* product_quantity
* product_weight
* product_code
* parent_code
* image
* url
* length
* width
* height
* expires

* sub_token_url
* subscription_frequency
* subscription_startdate
* subscription_nextdate
* subscription_enddate

* is_future_line_item
* shipto
* category_description
* category_code
* product_delivery_type

* transaction_detail_options


## Methods

*priceFormatted*
Returns a number formatted as 0.00. Default is `en_US` format.

```
priceFormatted($price, $locale = 'en_US')
```

*hasOptions*
Returns true if this item has option data.
```
hasOptions()
```

*optionName*
Retuens an array of names of options for this item.

```
optionName()
```

*optionValue*
Returns the value of options for this item.

```
optionValue()
```

{% include menu.md %}