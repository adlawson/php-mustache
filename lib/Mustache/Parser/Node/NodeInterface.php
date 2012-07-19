<?php
namespace Mustache\Parser\Node;

use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface NodeInterface
{
    /**
     * Check if the node supports a given token
     * 
     * @param TokenInterface $token
     * 
     * @return boolean
     */
    public static function supports(TokenInterface $token);

    /**
     * Compile the source
     * 
     * @param CompilerInterface $compiler
     */
    public function compile(CompilerInterface $compiler);

    /**
     * Set the next node
     * 
     * @param NodeInterface $node
     */
    public function setNext(NodeInterface $node);

    /**
     * Set the previous node
     * 
     * @param NodeInterface $node
     */
    public function setPrevious(NodeInterface $node);
}
