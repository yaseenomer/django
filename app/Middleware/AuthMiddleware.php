<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 12:04 PM
 */
namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request,$response,$next)
    {
        if (!$this->container->auth->check())
        {
            $this->container->flash->addMessage('error','Please sign in before doing that ');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        $response =$next($request, $response);
        return $response;
    }
}