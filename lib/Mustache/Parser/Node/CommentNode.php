<?php
namespace Mustache\Parser\Node;

use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Token\BlockToken;
use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class CommentNode extends Node
{
    /**
     * Check if the node supports a given token
     * 
     * @param TokenInterface $token
     * 
     * @return boolean
     */
    public static function supports(TokenInterface $token)
    {
        return $token instanceof BlockToken && 0 === strpos($token->getValue(), '!');
    }

    /**
     * Compile the source
     * 
     * @param CompilerInterface $compiler
     */
    public function compile(CompilerInterface $compiler)
    {
        if ($this->previous instanceof TextNode) {
            $compiler->write('$output = preg_replace(\'/(^|\n+)[^\S\n]+$/\', \'$1\', $output);');
        }

        if ($this->next instanceof TextNode) {
            $this->next->applyCallback(function($value) {
                return ltrim($value);
            });
        }
    }
}
