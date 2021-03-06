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
     * @param string $source
     * @param array|object $context The variable context
     * @param array $partials
     * 
     * @return string The rendered template
     */
    public function render($source, $context, array $partials = array())
    {
        $id = sha1($source);
        $cache = $this->environment->getCacheDriver();

        if (!$cache->exists($id)) {
            // Break up the source into simple tokens
            $tokenized = $this->environment->getLexer()->tokenize($source);

            // Using the tokens, build a parse tree
            $parseTree = $this->environment->getParser()->parse($tokenized);

            // Using the parse tree, compile the template
            $cache->write($this->environment->getCompiler()->compile($parseTree, $id), $id);
        }

        // Get the template instance
        $template = $cache->read($id);

        // Render the template
        return $template->render($context);
    }
}
