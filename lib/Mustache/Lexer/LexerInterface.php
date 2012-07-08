<?php
namespace Mustache\Lexer;

use Mustache\Lexer\Token\TokenStream;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface LexerInterface
{
    /**
     * Tokenize a template
     * 
     * @param string $template
     * 
     * @return TokenStream
     */
    public function tokenize($template);

    /**
     * Get the delimiters
     * 
     * @return array
     */
    public function getDelimiters();

    /**
     * Set the delimiters
     * 
     * @param string $start
     * @param string $end
     */
    public function setDelimiters($start, $end);
}
