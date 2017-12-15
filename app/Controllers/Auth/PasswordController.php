<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 2:35 AM
 */

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages as f;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;


class PasswordController extends Controller
{
    public function getChangePassword($request,  $response)
    {

      $this->view->render($response, 'auth/password/change.twig');


    }
    public function postChangePassword($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'old_password' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),

        ]);

        if ($validation->failed())
        {
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }
        $this->auth->user()->setPassword($request->getParam('password'));
        $this->flash->addMessage('info', 'Your Password Was Changed.');
        return $response->withRedirect($this->router->pathFor('home'));


    }

}
