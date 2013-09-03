<?php
namespace ObjectPersistence;

use ObjectPersistence\Backend\AbstractBackend;

class ObjectPersistence {
	protected $backend;
	protected $middleware;
	protected $settings;
	
	public function __construct() {
		
	}
	
	public function getBackend() {
		return $this->backend;
	}
	
	public function setBackend(AbstractBackend $backend) {
		$this->backend = $backend;
	}
	
	public function get($id) {
		return $this->backend->get($id);
	}
	
	public function save($object) {
		return $this->backend->save($object);
	}
}