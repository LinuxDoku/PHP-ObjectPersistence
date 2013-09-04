<?php
namespace ObjectPersistence\Backend;

use ObjectPersistence\Settings\SettingsInterface;
use ObjectPersistence\Exceptions\NonObjectException;

/**
 * All backends have to extend from this abstract class in order to provide
 * some basic features like settings and a pre defined api design.
 * 
 * This ensures that the backend implementation could be changed to whatever
 * the user likes.
 * 
 * @abstract
 */
abstract class AbstractBackend {
	
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
	 * @param \ObjectPersistence\Settings\SettingsInterface $settings optional
	 */
	public function __construct(SettingsInterface $settings=null) {
		$this->settings = $settings;
	}
	
	/**
	 * save an object to backend
	 * 
	 * @param object $object
	 * @return int access id, return type depends on backend implementation 
	 */
	abstract public function save($object);
	
	/**
	 * get an object from backend or if no id is given get all objects as array
	 * 
	 * @param int $id identifier of the stored object, if null get all objects
	 */
	abstract public function get($id=null);
	
	/**
	 * update/replace an object at id position
	 * 
	 * @param int $id storage identifier
	 * @param object $object new object
	 */
	abstract public function update($id, $object);
	
	/**
	 * delete an object of storage identifer is given or all if not
	 * 
	 * @param int $id storage identifier or null to delete all objects
	 */
	abstract public function delete($id=null);
	
	/**
	 * raise an exeption if it's not an object
	 * 
	 * @param int $object
	 * @throws NonObjectException
	 */	
	protected function validateObject($object) {
		if(!is_object($object)) {
			throw new NonObjectException('ObjectPersistence only supports objects.');
		}
	}
}