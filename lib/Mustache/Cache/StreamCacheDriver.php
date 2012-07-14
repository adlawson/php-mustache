<?php
namespace Mustache\Cache;

use Mustache\Environment;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class StreamCacheDriver implements CacheDriverInterface
{
    /**
     * @const string
     */
    const PROTOCOL = 'mustache';

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
        return file_exists($this->getTemplateUrl($id));
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

        $template = $this->environment->getTemplateNamespace() . '\\' .
                    $this->environment->getTemplatePrefix() . $id;

        include_once $this->getTemplateUrl($id);

        return new $template($this->environment);
    }

    /**
     * Write teplate source to the cache
     * 
     * @param string $source
     */
    public function write($source, $id)
    {
        $file = fopen($this->getTemplateUrl($id), "w");

        fwrite($file, $source);
        fclose($file);
    }

    /**
     * Get the URL to the template
     * 
     * @param string $id
     * 
     * @return string
     */
    protected function getTemplateUrl($id)
    {
        return static::PROTOCOL . '://' . $id;
    }
}
