<?php

use ObjectPersistence\ObjectPersistence;

abstract class AbstractBackendImplemtationTest extends PHPUnit_Framework_TestCase {
	protected $objectPersistence;
	
	public function __construct() {
		$this->objectPersistence = new ObjectPersistence();
		$this->setupBackend();
	}
	
	abstract function setupBackend();
	
	public function testSaveSimple() {
		$simpleObject = new stdClass;
		$simpleObject->foo = 'bar';
		
		$id = $this->objectPersistence->save($simpleObject);
		
		// check id
		$this->assertNotNull($id);
		$this->assertTrue(is_string($id));
		
		// check saved value
		$this->assertEquals($simpleObject, $this->objectPersistence->get($id));
		$this->assertEquals('bar', $this->objectPersistence->get($id)->foo);
	}
	
	public function testGet() {
		
	}
	
	public function testUpdate() {
		
	}
	
	public function testDelete() {
		
	}
}

