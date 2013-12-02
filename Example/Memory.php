<?php
require '../vendor/autoload.php';

use ObjectPersistence\Backend\Memory\Memory;
use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;

$settings = new Settings;
$settings->test = 'Hello World';
$settings->sub = new Settings;
$settings->sub->anotherTest = 'foo';
$settings->bar = 'lulz';

$objectPersistence = new ObjectPersistence;
$objectPersistence->setBackend(new Memory);

$id = $objectPersistence->save($settings);
$settings->sub = null;
$object = $objectPersistence->get($id);
print_r($object); // sub is not null, cause the backend clones objects before saving

//$objectPersistence->update(100, new Settings);