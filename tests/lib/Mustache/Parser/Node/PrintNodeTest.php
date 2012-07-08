<?php
namespace Mustache\Parser\Node;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class PrintNodeTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $node = new PrintNode('value');

        $this->assertInstanceOf('Mustache\Parser\Node\NodeInterface', $node);
    }

    public function testSupports()
    {
        $node = new PrintNode('value');

        $this->assertFalse($node->supports($this->getMock('Mustache\Lexer\Token\TokenInterface')));
    }

    public function testCompile()
    {
        $node = new PrintNode('value');
        $compiler = $this->getMock('Mustache\Compiler\CompilerInterface');

        $compiler->expects($this->once())
            ->method('write')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->never())
            ->method('indent')
            ->will($this->returnValue($compiler));

        $compiler->expects($this->never())
            ->method('outdent')
            ->will($this->returnValue($compiler));

        $node->compile($compiler);
    }
}
