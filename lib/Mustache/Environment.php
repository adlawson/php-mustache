<?php
namespace Mustache;

use Mustache\Cache\CacheDriverInterface;
use Mustache\Cache\StreamCacheDriver;
use Mustache\Compiler\Compiler;
use Mustache\Compiler\CompilerInterface;
use Mustache\Lexer\Lexer;
use Mustache\Lexer\LexerInterface;
use Mustache\Lexer\Token\TokenFactory;
use Mustache\Parser\Parser;
use Mustache\Parser\ParserInterface;
use Mustache\Parser\Node\NodeFactory;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Environment
{
    /**
     * @var CacheDriverInterface
     */
    protected $cacheDriver;

    /**
     * @var LexerInterface
     */
    protected $lexer;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @return CacheDriverInterface
     */
    public function getCacheDriver()
    {
        if (null === $this->cacheDriver) {
            $this->cacheDriver = new StreamCacheDriver($this);
            $this->cacheDriver->register('Mustache\Cache\Stream\MemoryWrapper');
        }

        return $this->cacheDriver;
    }

    /**
     * @return CompilerInterface
     */
    public function getCompiler()
    {
        return new Compiler(
            $this->getTemplatePrefix(),
            $this->getTemplateNamespace(),
            $this->getTemplateParent()
        );
    }

    /**
     * @return LexerInterface
     */
    public function getLexer()
    {
        if (null === $this->lexer) {
            $this->lexer = new Lexer(new TokenFactory());
        }

        return $this->lexer;
    }

    /**
     * @return ParserInterface
     */
    public function getParser()
    {
        if (null === $this->parser) {
            $this->parser = new Parser(new NodeFactory(array(
                'Mustache\Parser\Node\CommentNode',
                'Mustache\Parser\Node\PrintNode',
                'Mustache\Parser\Node\TextNode'
            )));
        }

        return $this->parser;
    }

    /**
     * @return string
     */
    public function getTemplateNamespace()
    {
        return 'Mustache\Template\CG';
    }

    /**
     * @return string
     */
    public function getTemplateParent()
    {
        return '\Mustache\Template\AbstractTemplate';
    }

    /**
     * @return string
     */
    public function getTemplatePrefix()
    {
        return 'Template_';
    }
}
