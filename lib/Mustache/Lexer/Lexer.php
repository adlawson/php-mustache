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
    const STATE_DEFAULT = 0;
    const STATE_BLOCK   = 1;

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
     * @var integer
     */
    protected $state;

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
            if (static::STATE_BLOCK === $this->state) {
                // Find the next occurrence of the end delimiter
                $position = $this->getNextCursorPosition($template, $this->delimiters[1]);

                // Get the trimmed content of the difference
                $content = substr($template, $this->cursor, ($position - $this->cursor));

                if ('=' === $content[0]) {
                    // Set the delimiters
                    $matches = explode(' ', trim($content, '= '));
                    $this->setDelimiters(reset($matches), end($matches));
                } else {
                    // Create a block token with the content
                    $stream->push(new BlockToken($content));
                }

                // Advance cursor to the new position
                $this->cursor = $position + strlen($this->delimiters[1]);

                // Set the new state
                $this->state = static::STATE_DEFAULT;
            } else {
                // Find the next occurrence of the start delimiter
                $position = $this->getNextCursorPosition($template, $this->delimiters[0]);

                // Create a simple token with the difference
                $token = new Token(substr($template, $this->cursor, ($position - $this->cursor)));
                $stream->push($token);

                // Advance cursor to the new position
                $this->cursor = $position + strlen($this->delimiters[0]);

                // Set the new state
                $this->state = static::STATE_BLOCK;
            }
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
        $this->cursor = 0;
        $this->line   = 1;
        $this->eof    = strlen($template);
        $this->state  = static::STATE_DEFAULT;

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

    /**
     * Get the next cursor position
     * 
     * @param string $template
     * @return integer
     */
    protected function getNextCursorPosition($template, $delimiter)
    {
        $position = strpos($template, $delimiter, $this->cursor);

        return false === $position ? $this->eof : $position;
    }
}
