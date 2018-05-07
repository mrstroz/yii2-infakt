# yii2-infakt
Infakt component for Yii 2 framework

[inFakt API Documentation](https://www.infakt.pl/developers)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require "mrstroz/yii2-infakt" "*"
```

or add

```
"mrstroz/yii2-infakt": "*"
```

to the require section of your `composer.json` file.

Usage
-----

1. Add component to your config file
```php
'components' => [
    // ...
    'infakt' => [
        'class' => 'mrstroz\infakt\Infakt',
        'apiKey' => 'xxxxxx',
    ],
]
```

2. Add new client
```php
/** @var Infakt $inFakt */
$inFakt = Yii::$app->infakt;
$response = $inFakt->call('clients', 'POST',
    ['client' =>
        [
            'company_name' => 'Infakt biuro rachunkowe',
            'nip' => '888-888-88-88'
        ]
    ]
);
```

3. Get client by ID
```php
/** @var Infakt $inFakt */
$inFakt = Yii::$app->infakt;
$response = $inFakt->call('clients/xxxxxx', 'GET');
```

4. Add new invoice
```php
/** @var Infakt $inFakt */
$inFakt = Yii::$app->infakt;
$response = $inFakt->call('invoices', 'POST',
    ['invoice' =>
        [
            'payment_method' => 'payu',
            'client_id' => 6567050,
            'services' => [
                [
                    'name' => 'Przykładowa Usługa',
                    'gross_price' => 6623,
                    'tax_symbol' => 23
                ]
            ]
        ]
    ]
);
```



Check [inFakt API Documentation](https://www.infakt.pl/developers) for all available options.