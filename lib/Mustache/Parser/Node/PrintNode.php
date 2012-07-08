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
class PrintNode implements NodeInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

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
        $compiler->write('echo isset($context[\'' . $this->value . '\'] ? $context[\'' . $this->value . '\'] : null;');
    }
}
