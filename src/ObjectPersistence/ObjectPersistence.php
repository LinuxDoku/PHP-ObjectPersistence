<?php
namespace ObjectPersistence;

use ObjectPersistence\Backend\AbstractBackend;

class ObjectPersistence {
	protected $backend;
	protected $middleware;
	protected $settings;
	protected $query;
	
	public function __construct() {
		
	}
	
	public function getBackend() {
		return $this->backend;
	}
	
	public function setBackend(AbstractBackend $backend) {
		$this->backend = $backend;
	}
	
	public function __call($name, $parameter) {
		return call_user_func_array(array($this->backend, $name), $parameter);
	}
}