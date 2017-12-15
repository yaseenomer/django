<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 7:45 AM
 */

namespace App\Middleware;


class Middleware
{
    protected $container;


    public function __construct($container)
    {
        $this->container = $container;
    }
}