<?php
namespace Mustache;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Mustache
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * Setup Mustache!
     *
     * @param Environment $environment
     */
    public function __construct(Environment $environment = null)
    {
        if (null === $environment) {
            $environment = new Environment();
        }

        $this->environment = $environment;
    }

    /**
     * Render the template
     *
     * @todo Cache tokenizeed templates
     * 
     * @param string $template
     * @param array|object $context The variable context
     * @param array $partials
     * 
     * @return string The rendered template
     */
    public function render($template, $context, array $partials = array())
    {
        $tokenizedTemplate = $this->environment->getLexer()->tokenize($template);

        
    }
}
