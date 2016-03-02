# Yii2-CAS
Simple wrapper for phpCAS in Yii2

> **NOTE:** Module is in initial development.
 jasig/phpCAS is required

## Configuration

config/param.php
```php
return [
	...
	'cas' => [
		'host' => 'https://app.example.com/',
		'port' => 443,
		'uri' => '/cas',
                'log_file' => '/tmp/phpCAS.log',
	],
	...
];
```

config/web.php
```php
$config = [
	...
	'bootstrap' => [... , 'cas'],
	'components' => [
		'casUser' => [
			'class' => 'alcad\cas\CasUser',
		]
	],
	'modules' => [
		'cas' => [
			'class' => 'alcad\cas\Cas',
		],
	]
	...
]
```

