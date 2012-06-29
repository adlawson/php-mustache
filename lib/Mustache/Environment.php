<?php
namespace Mustache;

use Mustache\Lexer\Lexer;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Environment
{
    /**
     * @return Lexer
     */
    public function getLexer()
    {
        return new Lexer();
    }
}
