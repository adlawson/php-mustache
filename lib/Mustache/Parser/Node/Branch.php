<?php
namespace Mustache\Parser\Node;

use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Branch extends \SplQueue implements NodeInterface, BranchInterface
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
     * @param array|Traversable $children
     */
    public function __construct($children = null)
    {
        if (null !== $children) {
            foreach ($children as $child) {
                $this->push($child);
            }
        }
    }

    /**
     * Check if the node supports a given token
     * 
     * @param TokenInterface $token
     * 
     * @return boolean
     */
    public static function supports(TokenInterface $token)
    {
        return false;
    }

    /**
     * Compile the source
     * 
     * @param CompilerInterface $compiler
     */
    public function compile(CompilerInterface $compiler)
    {
        foreach ($this as $node) {
            $node->compile($compiler);
        }
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
     * @param NodeInterface $node
     */
    public function setPrevious(NodeInterface $node)
    {
        $this->previous = $node;
    }

    /**
     * @param NodeInterface $node
     */
    public function push($node)
    {
        if ($node instanceof NodeInterface) {
            parent::push($node);
        }
    }

    /**
     * Get the node at the top of the queue
     * 
     * @return NodeInterface
     */
    public function top()
    {
        if ($this->count()) {
            return parent::top();
        }

        return null;
    }
}
