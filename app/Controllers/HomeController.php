<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 7:43 AM
 */

namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller
{

    public function index($request, $response)
    {


        return $this->view->render($response, 'home.twig');

    }
}