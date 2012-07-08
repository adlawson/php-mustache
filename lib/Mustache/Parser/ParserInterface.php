<?php
namespace Mustache\Parser;

use Mustache\Lexer\Token\TokenStream;
use Mustache\Parser\Node\NodeInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface ParserInterface
{
    /**
     * Parse a token stream
     * 
     * @param TokenStream $stream
     * 
     * @return NodeInterface
     */
    public function parse(TokenStream $stream);
}
