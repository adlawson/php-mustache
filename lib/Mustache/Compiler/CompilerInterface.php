<?php
namespace Mustache\Compiler;

use Mustache\Parser\Node\NodeInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface CompilerInterface
{
    /**
     * Compile a node
     * 
     * @param NodeInterface $node
     * @param string $id The template ID
     * 
     * @return TemplateInterface
     */
    public function compile(NodeInterface $node, $id);

    /**
     * Indent cursor
     * 
     * @return CompilerInterface $this
     */
    public function indent();

    /**
     * Outdent cursor
     * 
     * @return CompilerInterface $this
     */
    public function outdent();

    /**
     * Write to source
     * 
     * @param string $value
     * 
     * @return CompilerInterface $this
     */
    public function write($value);

    /**
     * Get the template class name
     * 
     * @return string
     */
    public function getClassName();

    /**
     * Get the template parent class name
     * 
     * @return string
     */
    public function getParentClassName();
}
