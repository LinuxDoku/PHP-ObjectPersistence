<?php
require '../Autoload/Bootstrap.php';

echo '<pre>';

use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;

$settings = array('test' => 'Hello World');

$objectPersistence = new ObjectPersistence;
$objectPersistence->setBackend(new \ObjectPersistence\Backend\MongoDB\MongoDB);

$id = $objectPersistence->save($settings);

print_r($objectPersistence->get($id));

$settings['foo'] = 'bar';

$objectPersistence->update($id, $settings);

print_r($objectPersistence->get($id));