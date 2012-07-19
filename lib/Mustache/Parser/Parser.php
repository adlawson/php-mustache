<?php
namespace Mustache\Parser;

use Mustache\Lexer\Token\TokenStream;
use Mustache\Parser\Node\Node;
use Mustache\Parser\Node\NodeFactory;
use Mustache\Parser\Node\RootNode;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Parser implements ParserInterface
{
    /**
     * @var NodeFactory
     */
    protected $factory;

    /**
     * @param NodeFactory $factory
     */
    public function __construct(NodeFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Parse a token stream
     * 
     * @param TokenStream $stream
     * 
     * @return RootNode
     */
    public function parse(TokenStream $stream)
    {
        $tree = $this->factory->createRoot();

        foreach ($stream as $token) {
            $node = $this->factory->createFromToken($token);

            if ($tree->count()) {
                $node->setPrevious($tree->top());
            }

            $tree->push($node);
        }

        return $tree;
    }
}
