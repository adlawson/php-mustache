<?php
namespace Mustache\Parser\Node;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class NodeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $factory = new NodeFactory(array());

        $this->assertInstanceOf('Mustache\Parser\Node\NodeFactory', $factory);
    }

    public function testCreateRoot()
    {
        $factory = new NodeFactory(array());

        $this->assertInstanceOf('Mustache\Parser\Node\Root', $factory->createRoot());
    }

    public function testCreateFromTokenWithSupportingNode()
    {
        $token = $this->getMock('Mustache\Lexer\Token\TokenInterface');
        $node  = $this->getMock('Mustache\Parser\Node\NodeInterface');
        
        $node->staticExpects($this->once())
            ->method('supports')
            ->with($token)
            ->will($this->returnValue(true));

        $factory = new NodeFactory(array(get_class($node)));

        $this->assertInstanceOf(get_class($node), $factory->createFromToken($token));
    }

    public function testCreateFromTokenWithoutSupportingNode()
    {
        $token = $this->getMock('Mustache\Lexer\Token\TokenInterface');
        $node  = $this->getMock('Mustache\Parser\Node\NodeInterface');

        $node->staticExpects($this->once())
            ->method('supports')
            ->with($token)
            ->will($this->returnValue(false));

        $factory = new NodeFactory(array(get_class($node)));

        $this->setExpectedException('Mustache\Parser\ParserException');

        $factory->createFromToken($token);
    }
}
