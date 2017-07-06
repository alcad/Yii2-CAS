# Yii2-CAS
Simple wrapper for phpCAS in Yii2

> **NOTE:** Module is in initial development.
 jasig/phpCAS is required

## Configuration



config/web.php
```php
$config = [
	...
	'bootstrap' => [... , 'cas'],

	'modules' => [
        'cas' => [
            'class' => 'alcad\cas\Cas',
            'host' => 'your.cas.server.com',
            'port' => 443,
            'uri' => '/cas',
            'logFile' => false, //'/tmp/phpCAS.log',
            'as casLogin' => [
                'class' => 'common\behaviors\CasLoginBehavior' //see example
            ]
        ],
	]
	...
]
```

