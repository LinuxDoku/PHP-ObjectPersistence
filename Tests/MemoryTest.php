<?php

use ObjectPersistence\Backend\Memory\Memory;
use ObjectPersistence\ObjectPersistence;

class MemoryTest extends \PHPUnit_Framework_TestCase {
	protected function getObjectPersistenceInstance() {
		$objectPersistence = new ObjectPersistence;
		$objectPersistence->setBackend(new Memory);
		return $objectPersistence;
	}
	
	public function testSimpleObject() {
		$objectPersistence = $this->getObjectPersistenceInstance();
		
		$object = new stdClass();
		$object->foo = 'bar';
		
		// save & get
		$id = $objectPersistence->save($object);
		$this->assertNotNull($id);
		$this->assertEquals(serialize($object), serialize($objectPersistence->get($id)));
		$this->assertEquals('bar', $objectPersistence->get($id)->foo);
		
		// update & get
		$object->foo = 'hello world';
		$objectPersistence->update($id, $object);
		$this->assertEquals(serialize($object), serialize($objectPersistence->get($id)));
		$this->assertEquals('hello world', $objectPersistence->get($id)->foo);
		
		// get more than one result
		$objectPersistence->save($object);
		$result = $objectPersistence->get();
		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 2);
		$this->assertContains($object, $result);
		$this->assertEquals('hello world', $objectPersistence->get()[1]->foo);
		
		// delete one
		$objectPersistence->delete($id);
		$this->assertEquals(1, count($objectPersistence->get()));
		
		// delete all
		$objectPersistence->delete();
		$this->assertEquals(0, count($objectPersistence->get()));
		$this->assertEquals(array(), $objectPersistence->get());
	}
	
	public function testDateObject() {
		$objectPersistence = $this->getObjectPersistenceInstance();
		
		
	}
}