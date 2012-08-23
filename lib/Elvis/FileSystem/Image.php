<?php

namespace Elvis\FileSystem;

class Image
{
    protected $_file = null;

    public function __construct(File $_file)
    {
        $this->_file = $_file;
    }

    public function getFile()
    {
        return $this->_file;
    }

    public function resize(\Array $_config = array())
    {
    }

    public function rotate($_degrees = 90)
    {
    }
}
