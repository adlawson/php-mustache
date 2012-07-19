<?php
namespace Mustache\Parser\Node;

use Mustache\Lexer\Token\TokenInterface;
use Mustache\Parser\ParserException;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class NodeFactory
{
    /**
     * @var array
     */
    protected $nodes = array();

    /**
     * @param array $node An array of supported node class names
     */
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * Create a root node
     * 
     * @return Root
     */
    public function createRoot()
    {
        return new Root();
    }

    /**
     * Create a node from a supported token
     * 
     * @param TokenInterface $token
     * 
     * @return NodeInterface
     */
    public function createFromToken(TokenInterface $token)
    {
        foreach ($this->nodes as $node) {
            if (true === call_user_func(array($node, 'supports'), $token)) {
                return new $node($token->getValue());
            }
        }

        throw new ParserException('No supporting node found for token ' . get_class($token) . '(' . $token->getValue() . ')');
    }
}
