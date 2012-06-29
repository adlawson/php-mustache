<?php
namespace Mustache\Lexer;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $lexer = new Lexer();

        $this->assertInstanceOf('Mustache\Lexer\LexerInterface', $lexer);
    }
}
