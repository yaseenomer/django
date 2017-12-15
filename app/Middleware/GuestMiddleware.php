<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 12:04 PM
 */
namespace App\Middleware;

class GuestMiddleware extends Middleware
{
    public function __invoke($request,$response,$next)
    {
        if ($this->container->auth->check())
        {
            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        $response =$next($request, $response);
        return $response;
    }
}