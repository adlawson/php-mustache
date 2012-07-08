<?php
namespace Mustache\Lexer\Token;

use Mustache\Lexer\LexerException;
use Mustache\Lexer\LexerInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class BlockToken implements TokenInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     * @param LexerInterface $lexer
     */
    public function __construct($value, LexerInterface $lexer)
    {
        $value = trim(strval($value));

        if (2 === substr_count($value, '=')) {
            $matches = explode(' ', trim($value, '='));
            $lexer->setDelimiters(reset($matches), end($matches));
        } else {
            $this->value = $value;
            $delimiters = $lexer->getDelimiters();

            if (false !== strpos($value, reset($delimiters)) || false !== strpos($value, end($delimiters))) {
                throw new LexerException('Invalid block value "' . $value . '"');
            }
        }
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
