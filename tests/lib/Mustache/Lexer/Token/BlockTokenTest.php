<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class BlockTokenTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->lexer = $this->getMock('Mustache\Lexer\LexerInterface');

        $this->lexer->expects($this->any())
            ->method('getDelimiters')
            ->will($this->returnValue(array('{{', '}}')));
    }

    public function testInterface()
    {
        $token = new BlockToken('value', $this->lexer);

        $this->assertInstanceOf('Mustache\Lexer\Token\TokenInterface', $token);
    }

    public function testValue()
    {
        $value = 'This is the token value. ' . PHP_EOL;
        $token = new BlockToken($value, $this->lexer);

        $this->assertSame(trim($value), $token->getValue());
    }
}
