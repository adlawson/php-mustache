<?php
namespace Mustache\Cache\Stream;

/**
 * @package  Mustache
 * @license  MIT License <LICENSE>
 * @link     http://github.com/adlawson/mustache
 */
class MemoryWrapper implements StreamWrapperInterface
{
    /**
     * The cursor position
     * 
     * @var integer
     */
    protected $cursor = 0;

    /**
     * Has the whole file been read
     * 
     * @var boolean
     */
    protected $eof = false;

    /**
     * The file ID
     * 
     * @var string
     */
    protected $id;

    /**
     * The storage
     * 
     * @var array
     */
    protected static $storage = array();

    /**
     * Open a stream
     * 
     * @param string $path
     * @param string $mode
     * @param integer $options
     * @param string &$opened_path
     * 
     * @return boolean
     */
    public function stream_open($path, $mode, $options, &$opened_path)
    {
        $url = parse_url($path);
        $this->id = $url['host'];
        $this->cursor = 0;

        return true;
    }

    /**
     * Read from the stream
     * 
     * @param integer $count
     * 
     * @return string
     */
    public function stream_read($count)
    {
        if (!$this->eof && $count) {
            $output = substr(static::$storage[$this->id], $this->cursor, $count);
            $this->cursor += strlen($output);
        }

        if (empty($output)) {
            $this->eof = true;
        }

        return $output;
    }

    /**
     * Write to the stream
     * 
     * @param string $data
     * 
     * @return integer The number of bytes successfully stored
     */
    public function stream_write($data)
    {
        static::$storage[$this->id] = $data;

        $this->cursor += strlen($data);

        return strlen($data);
    }

    /**
     * Check if the whole file has been read
     * 
     * @return boolean
     */
    public function stream_eof()
    {
        return $this->eof;
    }

    /**
     * Get template information
     * 
     * @return array|boolean
     */
    public function stream_stat()
    {
        if (!isset(static::$storage[$this->id])) {
            return false;
        }
        
        return array(
            'dev'     => 0,
            'ino'     => 0,
            'mode'    => 0,
            'nlink'   => 0,
            'uid'     => 0,
            'gid'     => 0,
            'rdev'    => 0,
            'size'    => strlen(static::$storage[$this->id]),
            'atime'   => time(),
            'mtime'   => time(),
            'ctime'   => time(),
            'blksize' => 0,
            'blocks'  => 0
        );
    }

    /**
     * Get template information over URL
     * 
     * @param string $path
     * 
     * @return array|boolean
     */
    public function url_stat($path)
    {
        $url = parse_url($path);
        $this->id = $url['host'];

        return $this->stream_stat();
    }
}
