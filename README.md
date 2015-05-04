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
			'class' => 'alcad\yii2-cas\CasUser',
		]
	],
	'modules' => [
		'cas' => [
			'class' => 'alcad\yii2-cas\Cas',
		],
	]
	...
]
```

