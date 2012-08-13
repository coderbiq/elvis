<?php
namespace Elvis\Redis;

interface Object
{
    /**
     * @return \Predis\Client
     */
    public function getDb();

    public function getKey();

    /**
     * @return \Elvis\Redis\Object
     */
    public function load($_key);

    /**
     * @return \Elvis\Redis\Object
     */
    public function setDb(\Predis\Client $_db);

    public function setKey($_key);
}
