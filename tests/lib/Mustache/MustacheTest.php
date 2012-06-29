<?php
namespace Mustache;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class MustacheTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->container = $this->getMock('Mustache\Environment');
    }

    public function testConstructorWithServiceContainer()
    {
        $mustache = new Mustache($this->container);

        $this->assertInstanceOf('Mustache\Mustache', $mustache);
    }

    public function testConstructorWithoutServiceContainer()
    {
        $mustache = new Mustache();

        $this->assertInstanceOf('Mustache\Mustache', $mustache);
    }
}
