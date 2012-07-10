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
     * @param string $template
     * @param array|object $context The variable context
     * @param array $partials
     * 
     * @return string The rendered template
     */
    public function render($template, $context, array $partials = array())
    {
        // Break up the template into simple tokens
        $tokenizedTemplate = $this->environment->getLexer()->tokenize($template);

        // Using the tokens, build a parse tree
        $parseTree = $this->environment->getParser()->parse($tokenizedTemplate);

        // Using the parse tree, compile the source code
        $source = $this->environment->getCompiler()->compile($parseTree);

        // Render the source
        return $source->render($context);
    }
}
