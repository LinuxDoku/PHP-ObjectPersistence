<?php
namespace ObjectPersistence\Middleware;

/**
 * A middleware hooks in as a layer between user code and backend implementation
 * so a generic function can be used without modification of ObjectPersistence
 * itself and without overriding the used backend just for exending.
 * 
 * Example purpose is a cache or permission layer.
 * 
 * @abstract
 */
class AbstractMiddleware implements MiddlewareInterface {
	
	/**
	 * Settings for the configured backend, e.g. credentials
	 * 
	 * @var \ObjectPersistence\Settings\SettingsInterface
	 */
	protected $settings;
	
	/**
	 * constructor accepts settings as an optional parameter
	 * e.g. some backend implementetations need credentials
	 * 
	 * @param \ObjectPersistence\Middleware\MiddlewareOptions $settings optional
	 */
	public function __construct(MiddlewareOptions $settings=null) {
		$this->settings = $settings;
	}
	
	/**
	 * save an object to backend
	 * 
	 * @param object $object
	 * @return int access id, return type depends on backend implementation 
	 */
	public function savePre($object) {
		
	}
	
	public function saveAfter($result, $object) {
		
	}
	
	/**
	 * get an object from backend or if no id is given get all objects as array
	 * 
	 * @param string $id identifier of the stored object, if null get all objects
	 */
	public function getPre($id=null) {
		
	}
	
	public function getAfter($result, $id = null) {
		
	}
	
	/**
	 * update/replace an object at id position
	 * 
	 * @param string $id storage identifier
	 * @param object $object new object
	 */
	public function updatePre($id, $object) {
		
	}
	
	public function updateAfter($result, $id, $object) {
		
	}
	
	/**
	 * delete an object of storage identifer is given or all if not
	 * 
	 * @param string $id storage identifier or null to delete all objects
	 */
	public function deletePre($id=null) {
		
	}
	
	public function deleteAfter($result, $id = null) {
		
	}
	
	/**
	 * raise an exeption if it's not an object
	 * 
	 * @param object $object
	 * @throws NonObjectException
	 */	
	protected function validateObject($object) {
		if(!is_object($object)) {
			throw new NonObjectException('ObjectPersistence only supports objects.');
		}
	}
}