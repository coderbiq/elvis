<?php

namespace Elvis\FileSystem;

class Dir
{
    protected $_path = null;

    public function __construct($_path = null)
    {
        $this->setPath($_path);
    }

    public function setPath($_path)
    {
        $this->_path = $_path;
        return $this;
    }

    public function getPath()
    {
        return $this->_path;
    }
}
