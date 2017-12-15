<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 7:51 AM
 */

namespace App\Middleware;



class ValidationErrorsMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {
    	if(isset($_SESSION['errors'])){
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        
        unset($_SESSION['errors']);
    }

        $response = $next($request, $response);
        return $response;
    }
}