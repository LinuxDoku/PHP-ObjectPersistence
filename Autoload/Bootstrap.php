<?php
require 'SplClassLoader.php';

$classLoader = new SplClassLoader('ObjectPersistence', '../src');
$classLoader->register();