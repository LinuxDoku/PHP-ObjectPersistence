<?php

use ObjectPersistence\Backend\MongoDB\MongoDB;
use ObjectPersistence\Settings\Settings;

class MongoDBBackendImplementationTest extends AbstractBackendImplemtationTestCase {
	public function setUp() {
		parent::setup();
		$settings = new Settings();
		$settings->server = 'mongodb://localhost:27017';
		$settings->database = 'ObjectPersistenceTest';
		$settings->collection = 'Storage';
		self::$objectPersistence->setBackend(new MongoDB($settings));
	}
}