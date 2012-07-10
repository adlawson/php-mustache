<?php
namespace Mustache\Template;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface TemplateInterface
{
    /**
     * Render the template
     *
     * @param array|object $context The variable context
     * 
     * @return string
     */
    public function render($context);
}
