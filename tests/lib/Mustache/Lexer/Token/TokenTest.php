<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class TokenTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $token = new Token('value');

        $this->assertInstanceOf('Mustache\Lexer\Token\TokenInterface', $token);
    }

    public function testValue()
    {
        $value = 'This is the token value. ' . PHP_EOL;
        $token = new Token($value);

        $this->assertSame($value, $token->getValue());
    }
}
