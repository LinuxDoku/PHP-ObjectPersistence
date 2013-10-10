<?php

use ObjectPersistence\Backend\Memory\Memory;

class MemoryBackendImplementationTest extends AbstractBackendImplemtationTest {
	public function setupBackend() {
		$this->objectPersistence->setBackend(new Memory);
	}
}