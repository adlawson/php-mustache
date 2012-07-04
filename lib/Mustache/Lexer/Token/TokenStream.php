<?php
namespace Mustache\Lexer\Token;

use Mustache\Lexer\Lexer;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class TokenStream extends \SplQueue
{
    /**
     * @param TokenInterface $token
     */
    public function push($token)
    {
        if ($token instanceof TokenInterface && !$this->isLocked()) {
            parent::push($token);
        }
    }

    /**
     * Check if the stream is locked to modification
     * 
     * @return boolean
     */
    public function isLocked()
    {
        return (0 < $this->count() && !$this->top() instanceof EofToken);
    }
}
