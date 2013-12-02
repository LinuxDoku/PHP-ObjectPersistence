<?php
use ObjectPersistence\ObjectPersistence;

abstract class AbstractBackendImplemtationTestCase extends PHPUnit_Framework_TestCase {
	protected static $objectPersistence;
	
	public function setUp() {
		self::$objectPersistence = new ObjectPersistence();
	}
	
	final private function handleException(Exception $e) {
		return 'Exception raised while saving simple object, Message: '.$e->getMessage().', Stack Strace: '.PHP_EOL.$e->getTraceAsString();
	}
	
	final public function testSave() {	
		$id = array();
		$objectPersistence = self::$objectPersistence;
		
		// simple object
		$simpleObject = new stdClass;
		$simpleObject->foo = 'bar';
		try {
			$id['simpleId'] = $objectPersistence->save($simpleObject);
		} catch(Exception $e) {
			$this->fail($this->handleException($e));
		}
				
		// date object
		$dateObject = new DateTime();
		try {
			$id['dateId'] = $objectPersistence->save($dateObject);
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
			$id['complexId'] = $objectPersistence->save($complexObject);
		} catch(Exception $e) {
			$this->fail($this->handleException($e));
		}
				
		return array($id, $objectPersistence);
	}
	
	/**
	 * @depends testSave
	 */
	final public function testGet(array $data) {
		$id = $data[0];
		$objectPersistence = $data[1];
				
		// check id
		$this->assertNotNull($id['simpleId']);
		$this->assertTrue(is_string($id['simpleId']));
				
		// check saved value
		$this->assertNotNull($objectPersistence->get($id['simpleId']));
		$this->assertTrue(is_object($objectPersistence->get($id['simpleId'])));
		$this->assertEquals('bar', $objectPersistence->get($id['simpleId'])->foo);
				
		return array($id, $objectPersistence);
	}
	
	/**
	 * @depends testGet
	 */
	final public function testUpdate(array $data) {
		$id = $data[0];
		$objectPersistence = $data[1];
		
		return array($id, $objectPersistence);
	}
	
	/**
	 * @depends testDelete
	 */
	final public function testDelete(array $data) {
		$id = $data[0];
		$objectPersistence = $data[1];
		
		
	}
}

