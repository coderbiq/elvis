<?php
namespace Test;

use Elvis\Redis as Redis;

/**
 * @group elvis
 * @group elvis-redis
 * @group elvis-redis-sortedset
 */
class SortedSetTest extends \PHPUnit_Framework_TestCase
    implements Redis\Value
{
    protected $_redis_data = null;

    public function testType()
    {
        $sorted_set = new Redis\SortedSet();
        $this->assertInstanceOf('Elvis\Redis\Object', $sorted_set);
    }

    public function testAdd()
    {
        $map = array(
            array(
                'zadd', 
                array(
                    'test', 1, 
                    array(
                        'class_name'=>get_class($this),
                        'redis_data'=>'test value')), 
                1),
            array(
                'zadd', 
                array(
                    'test',
                    1, array(
                        'class_name'=>get_class($this),
                        'redis_data'=>'test value'), 
                    2, 'test value'), 
                2)
        );
        $db = $this->getMock('\Predis\Client');
        $db->expects($this->any())
            ->method('__call')
            ->will($this->returnValueMap($map));

        $sorted_set = new Redis\SortedSet();
        $sorted_set->setDb($db);
        $sorted_set->setKey('test');

        $this->assertEquals(1, $sorted_set->zadd(1, $this));
        $this->assertEquals(2, $sorted_set->zadd(1, $this, 2, 'test value'));
    }

#    public function testLoad()
#    {
#        $db = $this->getMock('\Predis\Client', array('get'));
#        $db->expects($this->once())
#            ->method('get')
#            ->with($this->equalTo('test'))
#            ->will($this->returnValue('test value'));
#
#        $sorted_set = new Redis\SortedSet();
#        $sorted_set->setDb($db);
#        $sorted_set->load('test');
#
#        $this->assertEquals('test value', $sorted_set->getData());
#    }

    public static function createByRedisData($_redis_data)
    {
        $this->_redis_data = $_redis_data;
    }

    public function toRedisData()
    {
        return 'test value';
    }
}
