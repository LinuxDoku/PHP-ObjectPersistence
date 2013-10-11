<?php

use ObjectPersistence\ObjectPersistence;

abstract class AbstractBackendImplemtationTest extends PHPUnit_Framework_TestCase {
	protected $objectPersistence;
	
	public function __construct() {
		$this->objectPersistence = new ObjectPersistence();
		$this->setupBackend();
	}
	
	abstract function setupBackend();
	
	final public function testSaveSimple() {
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
	
	final public function testGet() {
		
	}
	
	final public function testUpdate() {
		
	}
	
	final public function testDelete() {
		
	}
}

