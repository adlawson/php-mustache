<?php
namespace Mustache\Parser\Node;

use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Token\TokenInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class RootNode implements NodeInterface
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
        return false;
    }

    /**
     * Compile the source
     * 
     * @param CompilerInterface $compiler
     */
    public function compile(CompilerInterface $compiler)
    {
        $this->compileClassHeader($compiler);

        $this->compileClassFooter($compiler);
    }

    /**
     * @param CompilerInterface $compiler
     */
    protected function compileClassFooter(CompilerInterface $compiler)
    {
        $compiler
            ->outdent()
            ->write('}');
    }

    /**
     * @param CompilerInterface $compiler
     */
    protected function compileClassHeader(CompilerInterface $compiler)
    {
        $compiler
            ->write('class ' . $compiler->getClassName() . ' extends ' . $compiler->getParentClassName())
            ->write('{')
            ->indent();
    }
}
