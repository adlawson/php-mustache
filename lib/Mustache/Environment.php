<?php
namespace Mustache;

use Mustache\Lexer\Lexer;
use Mustache\Lexer\Token\TokenFactory;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Environment
{
    /**
     * @var Lexer
     */
    protected $lexer;

    /**
     * @return Lexer
     */
    public function getLexer()
    {
        if (null === $this->lexer) {
            $this->lexer = new Lexer(new TokenFactory());
        }

        return $this->lexer;
    }
}
