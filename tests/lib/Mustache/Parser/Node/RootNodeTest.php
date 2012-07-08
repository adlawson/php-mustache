<?php
namespace Mustache\Parser\Node;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class RootNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $node = new RootNode();

        $this->assertInstanceOf('Mustache\Parser\Node\NodeInterface', $node);
    }

    public function testSupports()
    {
        $node = new RootNode();

        $this->assertFalse($node->supports($this->getMock('Mustache\Lexer\Token\TokenInterface')));
    }

    public function testCompile()
    {
        $node = new RootNode();
        $compiler = $this->getMock('Mustache\Compiler\CompilerInterface');

        $compiler->expects($this->atLeastOnce())
            ->method('write')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->once())
            ->method('indent')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->once())
            ->method('outdent')
            ->will($this->returnValue($compiler));

        $node->compile($compiler);
    }
}
