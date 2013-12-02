<?php
use ObjectPersistence\Backend\Memory\Memory;

class MemoryBackendImplementationTest extends AbstractBackendImplemtationTestCase {
	public function setUp() {
		parent::setup();
		self::$objectPersistence->setBackend(new Memory);
	}
}