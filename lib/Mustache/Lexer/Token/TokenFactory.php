<?php
namespace Mustache\Lexer\Token;

use Mustache\Lexer\LexerException;
use Mustache\Lexer\LexerInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class TokenFactory
{
    /**
     * Create a token stream
     * 
     * @return TokenStream
     */
    public function createStream()
    {
        return new TokenStream();
    }

    /**
     * Create a new token
     * 
     * @param string $value
     * 
     * @return Token
     */
    public function createToken($value)
    {
        return new Token($value);
    }

    /**
     * Create a new block token
     * 
     * @param string $value
     * @param LexerInterface $lexer
     * 
     * @return BlockToken
     */
    public function createBlockToken($value, LexerInterface $lexer)
    {
        return new BlockToken($value, $lexer);
    }
}
