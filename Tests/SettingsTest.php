<?php

use ObjectPersistence\Settings\Settings;

class SettingsTest extends PHPUnit_Framework_TestCase {
	public function testInstantiation() {
		$settings = new Settings;
		$this->assertInstanceOf('ObjectPersistence\Settings\Settings', $settings);
		
		$settings->foo = 'bar';
		$this->assertEquals($settings->foo, 'bar');
	}
	
	public function testInstantiationWithArray() {
		$array = array(
			'foo' => 'bar',
			'hello' => 'world'
		);
		
		$settings = new Settings($array);
		$this->assertInstanceOf('ObjectPersistence\Settings\Settings', $settings);
		
		$this->assertEquals($settings->foo, $array['foo']);
		$this->assertEquals($settings->hello, 'world');
	}
}