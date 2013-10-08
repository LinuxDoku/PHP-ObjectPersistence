<?php
namespace ObjectPersistence\Backend\MongoDB;

use ObjectPersistence\Backend\AbstractBackend;

class MongoDB extends AbstractBackend {
	protected $mongoDb;
	protected $database;
	protected $collection;
	
	public function __construct() {
		$this->mongoDb = new \MongoClient();
		$this->database = $this->mongoDb->ObjectPersistence;
		$this->collection = $this->database->Objects;
	}
	
	protected function getCriteria($id) {
		return array('_id' => new \MongoId($id));
	}
	
	public function delete($id = null) {
		$this->collection->remove($this->getCriteria($id));
	}

	public function get($id = null) {
		$result = $this->collection->findOne($this->getCriteria($id));
		unset($result['_id']); // remove mongodb _id
		return $result;
	}

	public function save($object) {
		$result = $this->collection->insert($object);
		if($result['ok'] == true) {
			return (string)$object['_id'];
		}
	}

	public function update($id, $object) {
		$result = $this->collection->update($this->getCriteria($id), $object);
		if($result['ok'] == true) {
			return (string)$object['_id'];
		}
	}	
}