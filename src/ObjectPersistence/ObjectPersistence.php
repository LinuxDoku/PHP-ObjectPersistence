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
	 * Route the method calls to our switchable backend and the middleware
	 * 
	 * @param string $name
	 * @param array $parameter
	 * @return mixed
	 */
	public function __call($name, $parameter) {
		$this->callMiddlewarePre($name, $parameter);
		// call backend
		$result = call_user_func_array(array($this->backend, $name), $parameter);
		$original = array_merge(array($result), $parameter);
		$this->callMiddlewareAfter($name, $original);
		return $result;
	}
	
	protected function callMiddleware($name, $parameter) {
		$middlewareOptions = $this->getMiddlewareOptions($parameter);
		
		if(count($this->middleware) == 0)
			return;
				
		foreach($this->middleware as $middleware) {
			if($middlewareOptions == null || 
			  ($middlewareOptions != null && !in_array(get_class($middleware), $middlewareOptions->disabledMiddleware))) {
				$result = call_user_func_array(array($middleware, $name), $parameter);
				if($result != null) {
					return $result;
				}
			}
		}
	}

	protected function callMiddlewarePre($name, $parameter) {
		$this->callMiddleware($name . 'Pre', $parameter);
	}
	
	protected function callMiddlewareAfter($name, $parameter) {
		$this->callMiddleware($name . 'After', $parameter);
	}
	
	protected function getMiddlewareOptions($parameter) {		
		if($parameter == null)
			return null;
						
		$middlewareOptions = $parameter[count($parameter) - 1];
		if(get_class($middlewareOptions) == 'ObjectPersistence\Middleware\MiddlewareOptions') {
			return $middlewareOptions;
		}
		
		return null;
	}
	
	protected function isInstancetypeInArray($instance, $array) {
		foreach($array as $middleware) {
			if($middleware instanceof $instance) {
				return true;
			}
		}
		return false;
	}
}