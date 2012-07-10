<?php
namespace Mustache;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class MustacheTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->environment = $this->getMock('Mustache\Environment');
    }

    public function setUpDependencies()
    {
        $this->node     = $this->getMock('Mustache\Parser\Node\NodeInterface');
        $this->stream   = $this->getMock('Mustache\Lexer\Token\TokenStream');
        $this->template = $this->getMock('Mustache\Template\TemplateInterface');

        $this->compiler = $this->getMock('Mustache\Compiler\CompilerInterface');
        $this->compiler->expects($this->any())
            ->method('compile')
            ->will($this->returnValue($this->template));

        $this->lexer = $this->getMock('Mustache\Lexer\LexerInterface');
        $this->lexer->expects($this->any())
            ->method('tokenize')
            ->will($this->returnValue($this->stream));

        $this->parser = $this->getMock('Mustache\Parser\ParserInterface');
        $this->parser->expects($this->any())
            ->method('parse')
            ->will($this->returnValue($this->node));

        $this->environment->expects($this->any())
            ->method('getCompiler')
            ->will($this->returnValue($this->compiler));

        $this->environment->expects($this->any())
            ->method('getLexer')
            ->will($this->returnValue($this->lexer));

        $this->environment->expects($this->any())
            ->method('getParser')
            ->will($this->returnValue($this->parser));
    }

    public function testConstructorWithEnvironment()
    {
        $mustache = new Mustache($this->environment);

        $this->assertInstanceOf('Mustache\Mustache', $mustache);
    }

    public function testConstructorWithoutEnvironment()
    {
        $mustache = new Mustache();

        $this->assertInstanceOf('Mustache\Mustache', $mustache);
    }

    public function testRenderWithContext()
    {
        $this->setUpDependencies();

        $mustache = new Mustache($this->environment);
        $context  = array('foo' => 'bar');
        $output   = 'template_output';

        $this->template->expects($this->once())
            ->method('render')
            ->with($context)
            ->will($this->returnValue($output));

        $this->assertSame($output, $mustache->render('template_source', $context));
    }

    public function testRenderWithContextAndPartials()
    {
        $this->setUpDependencies();

        $mustache = new Mustache($this->environment);
        $context  = array('foo' => 'bar');
        $partials = array('baz' => 'bam');
        $output   = 'template_output';

        $this->template->expects($this->once())
            ->method('render')
            ->with($context)
            ->will($this->returnValue($output));

        $this->assertSame($output, $mustache->render('template_source', $context, $partials));
    }
}
