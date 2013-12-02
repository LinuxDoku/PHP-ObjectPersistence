<?php
chdir(__DIR__);
require '../vendor/autoload.php';

use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;
use ObjectPersistence\Middleware\MiddlewareOptions;

class Test {
	
}

$settings = new \Test;
$settings->test = 'test';

$backendSettings = new Settings(
		array(
			'server' => 'mongodb://localhost:27017',
			'database' => 'ObjectPersistence',
			'collection' => 'Storage'
		)
);

$objectPersistence = new ObjectPersistence;
$backend = new \ObjectPersistence\Backend\MongoDB\MongoDB($backendSettings);
$objectPersistence->setBackend($backend);
$objectPersistence->addMiddleware(new \ObjectPersistence\Middleware\Cache\Cache);

$id = $objectPersistence->save($settings);

print_r($objectPersistence->get($id, new MiddlewareOptions(array('disabledMiddleware' => array('ObjectPersistence\Middleware\Cache\Cache')))));