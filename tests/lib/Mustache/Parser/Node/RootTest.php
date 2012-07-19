<?php
namespace Mustache\Parser\Node;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class RootTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $node = new Root();

        $this->assertInstanceOf('Mustache\Parser\Node\NodeInterface', $node);
    }

    public function testSupports()
    {
        $node = new Root();

        $this->assertFalse($node->supports($this->getMock('Mustache\Lexer\Token\TokenInterface')));
    }

    public function testCompile()
    {
        $node = new Root();
        $compiler = $this->getMock('Mustache\Compiler\CompilerInterface');

        $compiler->expects($this->atLeastOnce())
            ->method('write')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->atLeastOnce())
            ->method('indent')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->atLeastOnce())
            ->method('outdent')
            ->will($this->returnValue($compiler));

        $node->compile($compiler);
    }
}
