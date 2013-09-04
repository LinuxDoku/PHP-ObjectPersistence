<?php
namespace ObjectPersistence\Backend\Memory;

use ObjectPersistence\Backend\AbstractBackend;

/**
 * Backend implementation to store objects in the local computers memory.
 * 
 * The saved data is lost at the scripts end.
 */
class Memory extends AbstractBackend {
	protected $storage = array();

	public function get($id=null) {
		if($id === null)
			return $this->getAll();
		return $this->storage[$id];
	}
	
	protected function getAll() {
		$all = $this->storage;
		return array_values($all);
	}	

	public function save($object) {
		$this->validateObject($object);
		$this->storage[] = clone $object;
		end($this->storage);
		return key($this->storage);
	}
	
	public function update($id, $object) {
		$this->validateObject($object);
		$this->storage[$id] = $object;
	}

	public function delete($id=null) {
		if($id === null)
			$this->deleteAll();
		unset($this->storage[$id]);
	}
	
	protected function deleteAll() {
		foreach($this->get() as $id => $object) {
			$this->delete($id);
		}
	}
}