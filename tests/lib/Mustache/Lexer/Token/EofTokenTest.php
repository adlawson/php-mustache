<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class EofTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $token = new EofToken();

        $this->assertInstanceOf('Mustache\Lexer\Token\TokenInterface', $token);
    }

    public function testValue()
    {
        $token = new EofToken();

        $this->assertSame('', $token->getValue());
    }
}
