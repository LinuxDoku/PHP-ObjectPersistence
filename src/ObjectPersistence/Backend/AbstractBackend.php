<?php
namespace ObjectPersistence\Backend;

use ObjectPersistence\Settings\SettingsInterface;
use ObjectPersistence\Exceptions\NonObjectException;

abstract class AbstractBackend {
	protected $settings;
	
	public function __construct(SettingsInterface $settings=null) {
		$this->settings = $settings;
	}
	
	abstract public function save($object);
	abstract public function get($id=null);
	abstract public function update($id, $object);
	abstract public function delete($id);
	
	protected function validateObject($object) {
		if(!is_object($object)) {
			throw new NonObjectException('ObjectPersistence only supports objects.');
		}
	}
}