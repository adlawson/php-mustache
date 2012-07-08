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
}
