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
        $this->compileRenderMethodHeader($compiler);

        // foreach child

        $this->compileRenderMethodFooter($compiler);
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

    /**
     * @param CompilerInterface $compiler
     */
    protected function compileRenderMethodHeader(CompilerInterface $compiler)
    {
        $compiler
            ->write('/**')
            ->write(' * Render the template')
            ->write(' *')
            ->write(' * @param array|object $context The variable context')
            ->write(' *')
            ->write(' * @return string')
            ->write(' */')
            ->write('public function render($context)')
            ->write('{')
            ->indent();
    }

    /**
     * @param CompilerInterface $compiler
     */
    protected function compileRenderMethodFooter(CompilerInterface $compiler)
    {
        $compiler
            ->outdent()
            ->write('}');
    }
}
