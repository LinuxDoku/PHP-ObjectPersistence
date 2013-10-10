<?php
namespace ObjectPersistence\Backend\MongoDB;

use MongoClient;
use MongoId;
use ObjectPersistence\Backend\AbstractBackend;
use ObjectPersistence\Exceptions\NotSavedException;
use ObjectPersistence\Settings\SettingsInterface;

class MongoDB extends AbstractBackend {
	protected $mongoDb;
	protected $database;
	protected $collection;
	
	public function __construct(SettingsInterface $settings) {
		parent::__construct($settings);
		
		$this->mongoDb = new MongoClient($this->settings->server);
		$this->database = $this->mongoDb->{$this->settings->database};
		$this->collection = $this->database->{$this->settings->collection};
	}
	
	protected function getCriteria($id) {
		return array('_id' => new MongoId($id));
	}
	
	public function delete($id = null) {
		$this->collection->remove($this->getCriteria($id));
	}

	public function get($id = null) {
		if($id != null) {
			$result = (object)$this->collection->findOne($this->getCriteria($id));
			unset($result->_id); // remove mongodb _id
		} else {
			$result = array();
			foreach($this->collection->find() as $obj) {
				unset($obj['_id']); // remove mongodb _id
				$result[] = (object)$obj;
			}
		}
		return $result;
	}

	public function save($object) {
		$this->validateObject($object);
		$result = $this->collection->insert($object);
		if($result['ok'] == true) {
			return (string)$object->_id;
		} else {
			throw new NotSavedException;
		}
	}

	public function update($id, $object) {
		$this->validateObject($object);
		$result = $this->collection->update($this->getCriteria($id), $object);
		if($result['ok'] == true) {
			return (string)$object->_id;
		} else {
			throw new NotSavedException;
		}
	}	
}