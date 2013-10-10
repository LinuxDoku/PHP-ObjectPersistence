<?php
require '../vendor/autoload.php';

use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;

class Test {
	
}

$settings = new \Test;
$settings->test = 'test';

$backendSettings = new Settings(array('database' => 'ObjectPersistence', 'collection' => 'Storage'));

$objectPersistence = new ObjectPersistence;
$backend = new \ObjectPersistence\Backend\MongoDB\MongoDB($backendSettings);
$objectPersistence->setBackend($backend);

print_r($objectPersistence->get());