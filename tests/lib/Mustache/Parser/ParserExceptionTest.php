<?php
namespace Mustache\Parser;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class ParserExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $exception = new ParserException('exception_message');

        $this->assertInstanceOf('Mustache\ExceptionInterface', $exception);
    }
}
