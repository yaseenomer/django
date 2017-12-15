<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 5:51 AM
 */

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;


$app->get('/','HomeController:index')->setName('home');

$app->group('',function (){

    $this->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup','AuthController:postSignUp');

    $this->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin','AuthController:postSignIn');


})->add(new GuestMiddleware($container));


$app->group('',function (){
    $this->get('/auth/signout','AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change','PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change','PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));

$app->get('/lib/book','BookController:getBook')->setName('lib.book');
$app->post('/lib/book','BookController:postBook');

