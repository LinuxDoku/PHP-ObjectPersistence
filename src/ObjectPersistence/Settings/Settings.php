<?php
namespace ObjectPersistence\Settings;

class Settings implements SettingsInterface {
	protected $settings;
	
	public function __get($name) {
		return $this->settings[$name];
	}
	
	public function __set($name, $value) {
		$this->settings[$name] = $value;
	}
}