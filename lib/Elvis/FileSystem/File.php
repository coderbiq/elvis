<?php

namespace Elvis\FileSystem;

class File
{
    protected $_dir  = null;
    protected $_name = null;
    protected $_content = null;

    public function __construct($_name = null, Dir $_dir = null)
    {
        $this->setName($_name);
        $this->setDir($_dir);
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getFullName()
    {
        if($this->getName() == null || $this->getDir() == null)
            throw new Exception('文件信息错误');

        return sprintf('%s/%s', $this->getDir()->getPath(), $this->getName());
    }

    public function getExt()
    {
        return substr(strrchr($this->getName(), '.'), 1);
    }

    public function getDir()
    {
        return $this->_dir;
    }

    public function getContent()
    {
        if($this->_content == null)
            $this->read();
        return $this->_content;
    }

    public function setName($_name)
    {
        $this->_name = $_name;
        return $this;
    }

    public function setDir(Dir $_dir)
    {
        $this->_dir = $_dir;
        $this->_name;
    }

    public function read()
    {
        $this->_content = file_get_contents($this->getFullName());
        return $this->_content;
    }

    public function save()
    {
        file_put_contents($this->getFullName(), $this->getContent());
    }
}
