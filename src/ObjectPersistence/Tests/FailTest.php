<?php
namespace ObjectPersistence\Test;

use PHPUnit_Framework_TestCase;

class FailTest extends PHPUnit_Framework_TestCase {
	public function testFail() {
		$this->assertEquals(true, false);
	}
}