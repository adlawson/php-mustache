<?php
namespace Mustache\Lexer\Token;

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
        if ($token instanceof TokenInterface) {
            parent::push($token);
        }
    }
}
