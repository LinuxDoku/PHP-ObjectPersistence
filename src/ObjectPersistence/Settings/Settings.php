<?php
namespace ObjectPersistence\Settings;

use ObjectPersistence\Exceptions\NonArrayException;

class Settings implements SettingsInterface {
	protected $settings;
	
	public function __construct($settingsArray = null) {
		if($settingsArray !== null) {
			if(!is_array($settingsArray)) {
				throw new NonArrayException;
			}
			$this->settings = $settingsArray;
		}
	}
	
	public function __get($name) {
		return $this->settings[$name];
	}
	
	public function __set($name, $value) {
		$this->settings[$name] = $value;
	}
}