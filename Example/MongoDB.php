<?php
require '../vendor/autoload.php';

echo '<pre>';

use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;

class Test {
	
}

$settings = new \Test;
$settings->test = 'test';

$objectPersistence = new ObjectPersistence;
$objectPersistence->setBackend(new \ObjectPersistence\Backend\MongoDB\MongoDB);

$id = $objectPersistence->save($settings);

$settings->test2 = 'test2';

print_r($objectPersistence->get($id));

$objectPersistence->update($id, $settings);

print_r($objectPersistence->get($id));