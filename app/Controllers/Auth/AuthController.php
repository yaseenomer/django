<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 2:35 AM
 */

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Mail\Message;
use App\Models\User;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages as f;


class AuthController extends Controller
{

    public function getSignOut($request, $response)
    {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));


    }

    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');

    }

    public function postSignIn($request, $response)
    {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );
        if (!$auth) {
            $f = new f();
            $f->addMessage('error', 'could not sign you in with those details');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        return $response->withRedirect($this->router->pathFor('home'));

    }

    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response)
    {
        $validation = $this->validator->validate($request, [

            'email' => v::notEmpty()->email()->emailAvailable(),
            'name' => v::notEmpty(),
            'password' => v::notEmpty(),

        ]);


        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));

        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),

        ]);


        $f = new f();

        $f->addMessage('info', 'you Have been signed up!');

        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }
}