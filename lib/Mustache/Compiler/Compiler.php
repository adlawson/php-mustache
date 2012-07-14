<?php
namespace Mustache\Compiler;

use Mustache\Parser\Node\NodeInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Compiler implements CompilerInterface
{
    /**
     * @param string $prefix
     * @param string $namespace
     * @param string $parent
     */
    public function __construct($prefix, $namespace, $parent)
    {
        $this->namespace = $namespace;
        $this->parent    = $parent;
        $this->prefix    = $prefix;
    }

    /**
     * Compile a node
     * 
     * @param NodeInterface $node
     * @param string $id
     * 
     * @return string The compiled source
     */
    public function compile(NodeInterface $node, $id)
    {
        $this->prepare($id);

        $node->compile($this);

        return $this->source;
    }

    /**
     * Indent cursor
     * 
     * @return CompilerInterface $this
     */
    public function indent()
    {
        $this->indent += 1;

        return $this;
    }

    /**
     * Outdent cursor
     * 
     * @return CompilerInterface $this
     */
    public function outdent()
    {
        $this->indent -= 1;

        return $this;
    }

    /**
     * Write to source
     * 
     * @param string $value
     * 
     * @return CompilerInterface $this
     */
    public function write($value)
    {
        $this->source .= str_repeat(' ', $this->indent * 4);
        $this->source .= $value . PHP_EOL;

        return $this;
    }

    /**
     * Get the template class name
     * 
     * @return string
     */
    public function getClassName()
    {
        return $this->prefix . $this->id;
    }

    /**
     * Get the template parent class name
     * 
     * @return string
     */
    public function getParentClassName()
    {
        return $this->parent;
    }

    /**
     * Prepare
     */
    protected function prepare($id)
    {
        $this->id = $id;
        $this->indent = 0;
        $this->source = '';

        $this
            ->write('<?php')
            ->write('namespace ' . $this->namespace . ';')
            ->write('')
            ->write('/**')
            ->write(' * This template was compiled by Mustache')
            ->write(' *')
            ->write(' * @package  Mustache')
            ->write(' * @license  MIT License <LICENSE>')
            ->write(' * @link     http://github.com/adlawson/mustache')
            ->write(' */');
    }
}
