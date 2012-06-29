<?php
namespace Mustache\Lexer;

class LexerExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function messageDataProvider()
    {
        return array(
            array('Exception message', 'Exception message'),
            array('Exception message in "/path/to/template.format.mustache"', 'Exception message', '/path/to/template.format.mustache'),
            array('Exception message in "/path/to/template.format.mustache" on line 10', 'Exception message', '/path/to/template.format.mustache', 10)
        );
    }

    public function testInterface()
    {
        $exception = new LexerException('exception_message');

        $this->assertInstanceOf('Mustache\ExceptionInterface', $exception);
    }

    public function testPrevious()
    {
        $previous  = new \Exception();
        $exception = new LexerException('Exception message', null, null, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }

    /**
     * @dataProvider messageDataProvider
     * 
     * @param string $expected
     * @param string $message
     * @param string $template
     * @param integer $line
     */
    public function testGetMessage($expected, $message, $template = null, $line = null)
    {
        $exception = new LexerException($message, $template, $line);

        $this->assertSame($expected, $exception->getMessage());
    }
}
