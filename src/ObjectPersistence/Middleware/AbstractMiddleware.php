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
abstract class AbstractMiddleware {
	
}