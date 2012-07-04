<?php
namespace Mustache\Lexer;

use Mustache\Lexer\Token\TokenFactory;
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
     * @var integer
     */
    protected $cursor;

    /**
     * @var string
     */
    protected $encoding;

    /**
     * @var string
     */
    protected $end;

    /**
     * @var TokenFactory
     */
    protected $factory;

    /**
     * @var integer
     */
    protected $eof;

    /**
     * @var string
     */
    protected $start;

    /**
     * @var integer
     */
    protected $state;

    /**
     * @param TokenFactory $factory
     */
    public function __construct(TokenFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Tokenize a template
     * 
     * @param string $template
     * 
     * @return TokenStream
     */
    public function tokenize($template)
    {
        $stream = $this->factory->createStream();
        $this->prepare($template);

        while ($this->cursor < $this->eof) {
            if (static::STATE_BLOCK === $this->state) {
                // Find the next occurrence of the end delimiter
                $end = $this->getNextCursorPosition($template, $this->end);

                // Create the token
                $token = $this->factory->createBlockToken(substr($template, $this->cursor, ($end - $this->cursor)), $this);

                // Advance the cursor
                $this->cursor = $end + strlen($this->end);
                $this->state  = static::STATE_DEFAULT;
            } else {
                // Find the next occurrence of the start delimiter
                $end = $this->getNextCursorPosition($template, $this->start);

                // Create the token
                $token = $this->factory->createToken(substr($template, $this->cursor, ($end - $this->cursor)));

                // Advance the cursor
                $this->cursor = $end + strlen($this->start);
                $this->state  = static::STATE_BLOCK;
            }

            // Push the token onto the stream
            $stream->push($token);
        }

        $stream->push($this->factory->createEofToken());
        
        $this->tearDown();
        return $stream;
    }

    /**
     * Get the delimiters
     * 
     * @return array
     */
    public function getDelimiters()
    {
        return array($this->start, $this->end);
    }

    /**
     * Set the delimiters
     * 
     * @param string $start
     * @param string $end
     */
    public function setDelimiters($start, $end)
    {
        $this->end   = (string) $end;
        $this->start = (string) $start;
    }

    /**
     * Prepare
     * 
     * @param string $template
     */
    protected function prepare($template)
    {
        $this->encoding = mb_internal_encoding();
        mb_internal_encoding('ASCII');

        $this->setDelimiters(static::DELIMITER_START, static::DELIMITER_END);

        $this->cursor = 0;
        $this->eof    = strlen($template);
        $this->state  = 0 === strpos($template, $this->start) ? static::STATE_BLOCK: static::STATE_DEFAULT;
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
     * 
     * @return integer
     */
    protected function getNextCursorPosition($template, $delimiter)
    {
        $position = strpos($template, $delimiter, $this->cursor);

        return false === $position ? $this->eof : $position;
    }
}
