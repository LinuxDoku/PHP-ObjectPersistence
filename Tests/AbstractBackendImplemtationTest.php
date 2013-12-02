<?php

use ObjectPersistence\ObjectPersistence;

abstract class AbstractBackendImplemtationTest extends PHPUnit_Framework_TestCase {
	protected $objectPersistence;
	
	public function __construct() {
		$this->objectPersistence = new ObjectPersistence();
		$this->setupBackend();
	}
	
	abstract function setupBackend();
	
	final private function handleException(Exception $e) {
		return 'Exception raised while saving simple object, Message: '.$e->getMessage().', Stack Strace:'.PHP_EOL.$e->getTraceAsString();
	}
	
	final public function testSave() {	
		$id = array();
		
		// simple object
		$simpleObject = new stdClass;
		$simpleObject->foo = 'bar';
		try {
			$id['simpleId'] = $this->objectPersistence->save($simpleObject);
		} catch(Exception $e) {
			$this->fail($this->handleException($e));
		}
				
		// date object
		$dateObject = new DateTime();
		try {
			$id['dateId'] = $this->objectPersistence->save($dateObject);
		} catch(Exception $e) {
			$this->fail($this->handleException($e));
		}
		
		// complex object
		$complexObject = new stdClass;
		$complexObject->time = time();
		$complexObject->setTime = function($time) {
			$this->time = $time;
		};
		$complexObject->getTime = function() {
			return $this->time;
		};
		try {
			$id['complexId'] = $this->objectPersistence->save($complexObject);
		} catch(Exception $e) {
			$this->fail($this->handleException($e));
		}
		
		return $id;
	}
	
	/**
	 * @depends testSave
	 */
	final public function testGet(array $id) {	
		// check id
		$this->assertNotNull($id['simpleId']);
		$this->assertTrue(is_string($id['simpleId']));
				
		// check saved value
		$this->assertEquals($id['simpleId'], $this->objectPersistence->get($id['simpleId']));
		$this->assertEquals('bar', $this->objectPersistence->get($id['simpleId'])->foo);
				
		return $id;
	}
	
	/**
	 * @depends testGet
	 */
	final public function testUpdate(array $id) {
		
		return $id;
	}
	
	/**
	 * @depends testDelete
	 */
	final public function testDelete(array $id) {
		
	}
}

