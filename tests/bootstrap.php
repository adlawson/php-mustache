<?php

/**
 * Tests bootstrap
 * 
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
set_include_path(
    dirname( __DIR__ ) . '/lib' .
    PATH_SEPARATOR . get_include_path()
);

spl_autoload_register( function( $className ) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';

    if (($lastNsPos = strripos($className, '\\'))) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});