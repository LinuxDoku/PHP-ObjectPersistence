<?php
namespace ObjectPersistence\Backend\Memory;

use ObjectPersistence\Backend\AbstractBackend;
use ObjectPersistence\Exceptions\NotFoundException;

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
		
		if(isset($this->storage[$id]))
			return $this->storage[$id];
		else
			throw new NotFoundException;
	}
	
	protected function getAll() {
		$all = $this->storage;
		return array_values($all);
	}	

	public function save($object) {
		$this->validateObject($object);
		$this->storage[] = clone $object;
		end($this->storage);
		return (string)key($this->storage);
	}
	
	public function update($id, $object) {
		$this->validateObject($object);
		
		if(isset($this->storage[$id]))
			$this->storage[$id] = $object;
		else
			throw new NotFoundException;
	}

	public function delete($id=null) {
		if($id === null) {
			$this->deleteAll();
		} elseif(isset($this->storage[$id])) {
			unset($this->storage[$id]);
		} else {
			throw new NotFoundException;
		}
	}
	
	protected function deleteAll() {
		foreach($this->storage as $id => $object) {
			$this->delete($id);
		}
	}
}