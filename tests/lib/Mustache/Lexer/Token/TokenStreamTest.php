<?php
namespace Mustache\Lexer\Token;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class TokenStreamTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $queue = new TokenStream();

        $this->assertInstanceOf('SplQueue', $queue);
    }

    public function testPushToken()
    {
        $queue = new TokenStream();
        $queue->push($this->getMock('Mustache\Lexer\Token\TokenInterface'));

        $this->assertCount(1, $queue);
    }

    public function testPushNonToken()
    {
        $queue = new TokenStream();
        $queue->push(new \stdClass());

        $this->assertCount(0, $queue);
    }
}
