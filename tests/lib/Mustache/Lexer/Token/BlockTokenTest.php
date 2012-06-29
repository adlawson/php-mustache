<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class BlockTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $token = new BlockToken('value');

        $this->assertInstanceOf('Mustache\Lexer\Token\TokenInterface', $token);
    }

    public function testValue()
    {
        $value = 'This is the token value. ' . PHP_EOL;
        $token = new BlockToken($value);

        $this->assertSame(trim($value), $token->getValue());
    }
}
