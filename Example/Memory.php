<?php
require '../Autoload/Bootstrap.php';

use ObjectPersistence\Backend\Memory\Memory;
use ObjectPersistence\ObjectPersistence;
use ObjectPersistence\Settings\Settings;

$settings = new Settings();
$settings->test = "Hallo Welt";

$objectPersistence = new ObjectPersistence();
$objectPersistence->setBackend(new Memory());

$start = microtime(true);
for($i = 0; $i < 10000; $i++) {
	$id = $objectPersistence->save($settings);
	$objectPersistence->get($id);
}

$end = microtime(true);
echo $end - $start;