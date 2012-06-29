<?php
namespace Mustache\Lexer;

use Mustache\Lexer\Token\TokenStream;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Lexer implements LexerInterface
{
    /**
     * @const string
     */
    const DELIMITER_START = '{{';
    const DELIMITER_END   = '}}';

    /**
     * @const integer
     */
    const STATE_DATA     = 0;
    const STATE_BLOCK    = 1;
    const STATE_VARIABLE = 2;
    const STATE_STRING   = 3;

    /**
     * @var array
     */
    protected $delimiters = array();

    /**
     * @var integer
     */
    protected $cursor;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @var integer
     */
    protected $eof;

    /**
     * @var integer
     */
    protected $line;

    /**
     * Tokenize a template
     * 
     * @param string $template
     * 
     * @return TokenStream
     */
    public function tokenize($template)
    {
        $stream = new TokenStream();
        $this->prepare($template);

        while ($this->cursor < $this->eof) {

        }
        
        $this->tearDown();
        return $stream;
    }

    /**
     * Set the tag delimiters
     * 
     * @param string $start
     * @param string $end
     */
    public function setDelimiters($start, $end)
    {
        $this->delimiters = array($start, $end);
    }

    /**
     * Prepare
     * 
     * @param string $template
     */
    protected function prepare($template)
    {
        $this->cursor = -1;
        $this->line   = 1;
        $this->eof    = strlen($template);

        $this->setDelimiters(static::DELIMITER_START, static::DELIMITER_END);

        $this->encoding = mb_internal_encoding();
        mb_internal_encoding('ASCII');
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        if (is_string($this->encoding)) {
            mb_internal_encoding($this->encoding);
        }

        $this->encoding = null;
    }
}
