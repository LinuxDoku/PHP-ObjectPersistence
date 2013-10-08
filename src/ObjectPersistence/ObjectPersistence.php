<?php
namespace ObjectPersistence;

use ObjectPersistence\Backend\AbstractBackend;
use ObjectPersistence\Middleware\MiddlewareInterface;

class ObjectPersistence {
	
	/**
	 * Executeable backend implementation instance
	 * 
	 * @var \ObjectPersistence\Backend\AbstractBackend
	 */
	protected $backend;
	
	/**
	 * Array of our middleware components
	 * 
	 * @var array 
	 */
	protected $middleware;
	
	/**
	 * Settings for our backend, e.g. credentials
	 *
	 * @var \ObjectPersistence\Settings\SettingsInterface 
	 */
	protected $settings;
	
	public function __construct() {
		
	}
	
	/**
	 * Get current set backend implementation
	 * 
	 * @return \ObjectPersistence\Backend\AbstractBackend
	 */
	public function getBackend() {
		return $this->backend;
	}
	
	/**
	 * Set backend where the objects were stored
	 * 
	 * @param \ObjectPersistence\Backend\AbstractBackend $backend
	 */
	public function setBackend(AbstractBackend $backend) {
		$this->backend = $backend;
	}
	
	/**
	 * Add middleware to our object persistance layer
	 * 
	 * @param \ObjectPersistence\Middleware\MiddlewareInterface $middleware
	 */
	public function addMiddleware(MiddlewareInterface $middleware) {
		$this->middleware[] = $middleware;
	}
	
	/**
	 * Route the method calls to our switchable backend
	 * 
	 * @param string $name
	 * @param array $parameter
	 * @return mixed
	 */
	public function __call($name, $parameter) {
		return call_user_func_array(array($this->backend, $name), $parameter);
	}
}