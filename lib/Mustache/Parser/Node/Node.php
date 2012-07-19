<?php
namespace Mustache\Parser\Node;

use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
abstract class Node implements NodeInterface
{
    /**
     * @var NodeInterface
     */
    protected $next;

    /**
     * @var NodeInterface
     */
    protected $previous;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = strval($value);
    }

    /**
     * Set the next node
     * 
     * @param NodeInterface $node
     */
    public function setNext(NodeInterface $node)
    {
        $this->next = $node;
    }

    /**
     * Set the previous node
     *
     * This also sets self as the next node on the
     * node given here.
     * 
     * @param NodeInterface $node
     */
    public function setPrevious(NodeInterface $node)
    {
        $this->previous = $node;

        $node->setNext($this);
    }
}
