<?php
namespace Mustache\Lexer;

use Mustache\ExceptionInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class LexerException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var integer
     */
    protected $line;

    /**
     * @var string
     */
    protected $raw;

    /**
     * @var string
     */
    protected $template;

    /**
     * @param string $message
     * @param integer $line The line number
     * @param string $template The template file name
     * @param Exception $previous
     */
    public function __construct($message, $template = null, $line = null, \Exception $previous = null)
    {
        $this->line = $line;
        $this->raw  = $message;
        $this->template = $template;

        parent::__construct($this->compileMessage(), 0, $previous);
    }

    /**
     * Get the raw message
     * 
     * @return string
     */
    public function getRawMessage()
    {
        return $this->raw;
    }

    /**
     * Get the template file name
     * 
     * @return string
     */
    public function getTemplateName()
    {
        return $this->template;
    }

    /**
     * Get the template line number
     * 
     * @return string
     */
    public function getTemplateLine()
    {
        return $this->line;
    }

    /**
     * Compile the message from available properties
     * 
     * @return string
     */
    protected function compileMessage()
    {
        $message = $this->getRawMessage();

        if (null !== $this->getTemplateName()) {
            $message .= ' in "' . $this->getTemplateName() . '"';

            if (null !== $this->getTemplateLine()) {
                $message .= ' on line ' . $this->getTemplateLine();
            }
        }

        return $message;
    }
}
