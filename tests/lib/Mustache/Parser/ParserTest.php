<?php
namespace Mustache\Parser;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = $this->getMockBuilder('Mustache\Parser\Node\NodeFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $this->parser = new Parser($this->factory);
    }

    public function testInterface()
    {
        $this->assertInstanceOf('Mustache\Parser\ParserInterface', $this->parser);
    }

    public function testParse()
    {
        $node   = $this->getMock('Mustache\Parser\Node\Root');
        $stream = $this->getMock('Mustache\Lexer\Token\TokenStream');

        $this->factory->expects($this->once())
            ->method('createRoot')
            ->will($this->returnValue($node));

        $this->assertSame($node, $this->parser->parse($stream));
    }
}
