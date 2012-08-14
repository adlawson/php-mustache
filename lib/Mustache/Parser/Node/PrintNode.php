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
class PrintNode extends Node
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
        return $token instanceof BlockToken && false === strpos($token->getValue(), ' ');
    }

    /**
     * Compile the source
     *
     * @param CompilerInterface $compiler
     */
    public function compile(CompilerInterface $compiler)
    {
        $compiler->write('$output .= isset($context[\'' . $this->value . '\']) ? $context[\'' . $this->value . '\'] : null;');
    }
}
