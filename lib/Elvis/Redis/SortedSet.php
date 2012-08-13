<?php
namespace Elvis\Redis;

class SortedSet implements Object
{
    protected $_db;
    protected $_key;
    protected $_data;

    public function getDb()
    {
        return $this->_db;
    }

    public function getKey()
    {
        return $this->_key;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setDb(\Predis\Client $_db)
    {
        $this->_db = $_db;
        return $this;
    }

    public function setKey($_key)
    {
        $this->_key = $_key;
        return $this;
    }

    public function load($_key)
    {
        $this->_data = $this->getDb()->get($_key);
        return $this;
    }

    protected function _initParams($_args)
    {
        $params = array($this->getKey());
        foreach($_args as $arg)
        {
            if($arg instanceof Value)
            {
                $params[] = array(
                    'class_name' => get_class($arg),
                    'redis_data'=>$arg->toRedisData());
            }
            else
                $params[] = $arg;
        }

        return $params;
    }

    public function __call($_method_name, $_args)
    {
        return $this->getDb()
            ->__call($_method_name, $this->_initParams($_args));
    }
}
