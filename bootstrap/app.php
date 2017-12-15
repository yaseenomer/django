<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 5:41 AM
 */



use Respect\Validation\Validator as v;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();

require __DIR__ . '/../vendor/autoload.php';


$app = new \Slim\App([
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' =>
            [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'username' => 'root',
                'password' => '',
                'database' => 'test',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => ''

            ]
    ]

]);

$container = $app->getContainer();


$capsule = new Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

$container['flash'] =function ($container){
    return new \Slim\Flash\Messages;
};

$container['validator']=function ($container){
    return new App\Validation\Validator;
};






$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    $view->getEnvironment()->addGlobal('flash',$container->flash);

    return $view;

};

$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));


$container['mail'] = function ($container){
    $mailer  = new PHPMailer(true);

    $mailer->SMTPDebug = 2;                                 // Enable verbose debug output
    $mailer->isSMTP();                                      // Set mailer to use SMTP
    $mailer->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mailer->SMTPAuth = true;                               // Enable SMTP authentication
    $mailer->Username = 'yaseeno373@gmail.com';                 // SMTP username
    $mailer->Password = 'fatfat123';                           // SMTP password
    $mailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mailer->Port = 587;
    $mailer->isHTML(true);
    return new \App\Mail\Mailer($app->view, $mailer);

};



$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

// with my


$container['BookController'] = function ($container) {
    return new \App\Controllers\BookController($container);
};





// end with my
$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function ($container) {
    return new \App\Controllers\Auth\PasswordController($container);
};

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};




$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');


require __DIR__ . '/../app/routes.php';