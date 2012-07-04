<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class EofToken implements TokenInterface
{
    /**
     * @return string
     */
    public function getValue()
    {
        return '';
    }
}
