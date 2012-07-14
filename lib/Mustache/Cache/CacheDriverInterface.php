<?php
namespace Mustache\Cache;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface CacheDriverInterface
{
    /**
     * Check if a template exists in the cache
     * 
     * @param string $id
     * 
     * @return boolean
     */
    public function exists($id);

    /**
     * Get a template from the cache
     *
     * @param string $id
     * 
     * @return TemplateInterface
     */
    public function read($id);

    /**
     * Write teplate source to the cache
     * 
     * @param string $source
     */
    public function write($source, $id);
}
