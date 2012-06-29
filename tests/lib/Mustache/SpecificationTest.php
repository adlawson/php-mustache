<?php
namespace Mustache;

/**
 * Test against the official Mustache specification
 * 
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 *
 * @group integration
 * @group specification
 */
class SpecificationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function specificationDataProvider()
    {
        $dataprovider  = array();
        $iterator = new \FilesystemIterator(dirname(dirname(__DIR__)) . '/spec/specs');

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->isReadable() && 'json' === $file->getExtension()) {
                $data = json_decode(file_get_contents($file->getPathname()), true);

                $dataprovider = array_merge($dataprovider, $data['tests']);
            }
        }

        return $dataprovider;
    }

    /**
     * @dataProvider specificationDataProvider
     * 
     * @param string $name The test name
     * @param array $data The variable data
     * @param string $expected The expected result
     * @param string $template The template to test
     * @param string $description The test description
     * @param array $partials The partial templates
     */
    public function testSpecification($name, $data, $expected, $template, $description, array $partials = array())
    {
        $mustache = new Mustache;

        $result = $mustache->render($template, $data, $partials);

        $this->assertSame($expected, $result);
    }
}
