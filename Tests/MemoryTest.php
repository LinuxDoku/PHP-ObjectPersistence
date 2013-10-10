<?php

use ObjectPersistence\Backend\Memory\Memory;
use ObjectPersistence\ObjectPersistence;

class MemoryTest extends \PHPUnit_Framework_TestCase {
	public function testSimpleObject() {
		$object = new stdClass();
		$object->foo = 'bar';
		
		$objectPersistence = new ObjectPersistence;
		$objectPersistence->setBackend(new Memory);
		
		$id = $objectPersistence->save($object);
		$this->assertNotNull($id);
		
		$this->assertEquals(serialize($object), serialize($objectPersistence->get($id)));
	}
}