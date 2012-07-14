<?php
namespace Mustache;

use Mustache\Cache\StreamCacheDriver;
use Mustache\Compiler\Compiler;
use Mustache\Lexer\Lexer;
use Mustache\Lexer\Token\TokenFactory;
use Mustache\Parser\Parser;
use Mustache\Parser\Node\NodeFactory;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class Environment
{
    /**
     * @var StreamCacheDriver
     */
    protected $cacheDriver;

    /**
     * @var Lexer
     */
    protected $lexer;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @return StreamCacheDriver
     */
    public function getCacheDriver()
    {
        if (null === $this->cacheDriver) {
            if (!in_array(StreamCacheDriver::PROTOCOL, stream_get_wrappers())) {
                stream_wrapper_register(StreamCacheDriver::PROTOCOL, 'Mustache\Cache\Stream\MemoryWrapper');
            }

            $this->cacheDriver = new StreamCacheDriver($this);
        }

        return $this->cacheDriver;
    }

    /**
     * @return Compiler
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
     * @return Lexer
     */
    public function getLexer()
    {
        if (null === $this->lexer) {
            $this->lexer = new Lexer(new TokenFactory());
        }

        return $this->lexer;
    }

    /**
     * @return Parser
     */
    public function getParser()
    {
        if (null === $this->parser) {
            $this->parser = new Parser(new NodeFactory(array(
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
