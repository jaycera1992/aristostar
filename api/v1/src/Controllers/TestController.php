<?php
namespace App\Controllers;

use Ehann\RediSearch\Index;
use Predis\Client as Predis;
//use Ehann\RediSearch\Redis as RediSearch;

/**
 * Class TestController
 * @package App\Controllers
 */

class TestController
{
    public function __construct(Predis $redisMaster, Predis $redisSlave)
    {
        $this->redisMaster  = $redisMaster;
        $this->redisSlave   = $redisSlave;
    }


    /**
     * @param $request
     * @param $response
     * @return $response
     */


    public function testRedis($request, $response, $args)
    {
        var_dump('xx');
    }

    public function test($request, $response, $args)
    {
        var_dump('111');
    }

}
