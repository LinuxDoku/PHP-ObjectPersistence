<?php
namespace ObjectPersistence\Middleware\Cache;

use ObjectPersistence\Middleware\AbstractMiddleware;
use ObjectPersistence\Settings\SettingsInterface;

class Cache extends AbstractMiddleware {
	protected $cache;
	
	public function __construct(SettingsInterface $settings = null) {
		parent::__construct($settings);
		$this->cache = array();
	}
	
	public function getPre($id = null) {
		if(isset($this->cache[$id]))
			return $this->cache[$id];
	}
	
	public function getAfter($result, $id = null) {
		$this->cache[$id] = $result;
	}
}