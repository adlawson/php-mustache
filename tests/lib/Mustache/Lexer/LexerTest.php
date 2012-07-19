<?php
namespace Mustache\Lexer;

use Mustache\Lexer\Token\BlockToken;
use Mustache\Lexer\Token\Token;
use Mustache\Lexer\Token\TokenStream;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new \Mustache\Lexer\Token\TokenFactory();
    }

    public function testInterface()
    {
        $lexer = new Lexer($this->factory);

        $this->assertInstanceOf('Mustache\Lexer\LexerInterface', $lexer);
    }

    public function testSimpleTokenize()
    {
        $lexer = new Lexer($this->factory);
        $template = 'This is {{ mustache }}.
        {{=<% %>=}}
        I just changed the <% delimiters %>';

        $expected = new TokenStream();
        $expected->push(new Token('This is '));
        $expected->push(new BlockToken(' mustache ', $lexer));
        $expected->push(new Token('.' . PHP_EOL . '        '));
        $expected->push(new BlockToken('=<% %>=', $lexer));
        $expected->push(new Token(PHP_EOL . '        I just changed the '));
        $expected->push(new BlockToken(' delimiters ', $lexer));

        $this->assertStream($expected, $lexer->tokenize($template));
    }

    /**
     * Assert that two token streams are equal
     * 
     * @param TokenStream $expected
     * @param TokenStream $actual
     */
    public function assertStream(TokenStream $expected, TokenStream $actual)
    {
        if (count($expected) !== count($actual)) {
            ob_start();
            var_dump($expected);
            $expectedDump = ob_get_clean();

            ob_start();
            var_dump($actual);
            $actualDump = ob_get_clean();

            $this->failDump($expectedDump, $actualDump, 'Streams are not equal');
        }

        foreach ($expected as $i => $token) {
            if (!$actual->offsetExists($i) ||
                $token != $actual->offsetGet($i) ||
                $token->getValue() !== $actual->offsetGet($i)->getValue()) {

                ob_start();
                if ($actual->offsetExists($i)) {
                    var_dump($actual->offsetGet($i));
                } else {
                    var_dump(null);
                }
                $actualDump = ob_get_clean();

                ob_start();
                var_dump($token);
                $expectedDump = ob_get_clean();

                $this->failDump($expectedDump, $actualDump, 'Tokens in stream are not equal.');
            }
        }

        $this->assertTrue(true);
    }

    /**
     * Fail with var dumps
     * 
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    protected function failDump($expected, $actual, $message)
    {
        $this->fail(
            $message . PHP_EOL .
            '--- Expected' . PHP_EOL .
            '+++ Actual' . PHP_EOL .
            '@@ @@' . PHP_EOL .
            '- ' . $expected .
            '+ ' . $actual
        );
    }
}
