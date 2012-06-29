<?php
namespace Mustache\Lexer\Token;

use Mustache\Lexer\Modifier\ModifierInterface;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class BlockToken extends Token
{
    /**
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(trim(strval($value)));
    }
}
