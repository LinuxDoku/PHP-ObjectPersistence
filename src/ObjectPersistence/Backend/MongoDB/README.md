# ObjectPersistence\Backend\MongoDB
This backend implementation depends on the offical mongodb connection library.

Read more: http://www.php.net/manual/en/book.mongo.php

## Configuration
```php
$objectPersistence = new ObjectPersistence\ObjectPersistence;

$settings = new Settings(
	array(
		'server' => 'mongodb://localhost:27017',
		'database' => 'ObjectPersistence',
		'collection' => 'Storage'
	)
);
$backend = new \ObjectPersistence\Backend\MongoDB\MongoDB($settings);

$objectPersistence->setBackend($backend);
```