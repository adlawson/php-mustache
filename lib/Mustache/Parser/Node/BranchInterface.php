<?php
namespace Mustache\Parser\Node;

use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface BranchInterface
{
    /**
     * Push a node onto the queue
     * 
     * @param NodeInterface $node
     */
    public function push($node);

    /**
     * Get the node at the top of the queue
     * 
     * @return NodeInterface
     */
    public function top();
}
