<?php

namespace Elvis\Redis;

interface Value
{
    /**
     * 根据当前对象的Redis存储格式创建实例
     *
     * @param String $_redis_data
     * @return \Elvis\Redis\Value
     */
    public static function createByRedisData($_redis_data);

    /**
     * 输出当前实例的Redis存储格式
     *
     * @return String
     */
    public function toRedisData();
}
