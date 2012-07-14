<?php
namespace Mustache\Cache\Stream;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
interface StreamWrapperInterface
{
    /**
     * Open a template from the stream
     * 
     * @param string $path
     * @param string $mode
     * @param integer $options
     * @param string &$opened_path
     * 
     * @return boolean
     */
    public function stream_open($path, $mode, $options, &$opened_path);

    /**
     * Read a template from the stream
     * 
     * @param integer $count
     * 
     * @return string
     */
    public function stream_read($count);

    /**
     * Write a template to the stream
     * 
     * @param string $data
     * 
     * @return integer The number of bytes successfully stored
     */
    public function stream_write($data);

    /**
     * Check if the whole file has been read
     * 
     * @return boolean
     */
    public function stream_eof();

    /**
     * Get template information
     * 
     * @return array
     */
    public function stream_stat();
}
