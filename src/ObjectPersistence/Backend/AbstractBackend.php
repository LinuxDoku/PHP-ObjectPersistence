<?php
namespace ObjectPersistence\Backend;

use ObjectPersistence\Settings\SettingsInterface;

abstract class AbstractBackend {
	protected $settings;
	
	public function __construct(SettingsInterface $settings=null) {
		$this->settings = $settings;
	}
	
	abstract public function save($object);
	abstract public function get($id);
	abstract public function getAll();
	abstract public function delete($id);
}