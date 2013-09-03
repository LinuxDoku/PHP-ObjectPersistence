<?php
namespace ObjectPersistence\Backend\Memory;

use ObjectPersistence\Backend\AbstractBackend;

class Memory extends AbstractBackend {
	protected $storage = array();

	public function get($id) {
		return $this->storage[$id];
	}

	public function save($object) {
		$this->storage[] = $object;
		end($this->storage);
		return key($this->storage);
	}

	public function delete($id) {
		unset($this->storage[$id]);
	}	
}