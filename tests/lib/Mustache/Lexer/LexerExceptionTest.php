<?php
namespace Mustache\Lexer;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class LexerExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $exception = new LexerException('exception_message');

        $this->assertInstanceOf('Mustache\ExceptionInterface', $exception);
    }
}
