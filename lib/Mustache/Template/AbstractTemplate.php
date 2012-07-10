<?php
namespace Mustache\Template;

use Mustache\Environment;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
abstract class AbstractTemplate implements TemplateInterface
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }
}
