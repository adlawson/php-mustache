<?php
namespace Mustache\Cache;

use Mustache\Environment;

/**
 * @todo Base the cache on streams rather than eval :D
 * 
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class ArrayDriver implements CacheDriverInterface
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var array
     */
    protected $storage = array();

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Check if a template exists in the cache
     * 
     * @param string $id
     * 
     * @return boolean
     */
    public function exists($id)
    {
        return isset($this->storage[$id]);
    }

    /**
     * Get a template from the cache
     * 
     * @param string $id
     * 
     * @return TemplateInterface
     */
    public function read($id)
    {
        if (!$this->exists($id)) {
            throw new CacheException('No template found with ID "' . $id . '"');
        }

        return $this->storage[$id];
    }

    /**
     * Write teplate source to the cache
     * 
     * @param string $source
     */
    public function write($source, $id)
    {
        $template = $this->environment->getTemplateNamespace() . '\\' .
                    $this->environment->getTemplatePrefix() . $id;

        if (!class_exists($template, false)) {
            eval('?>' . $source);
        }

        $this->storage[$id] = new $template($this->environment);
    }
}
