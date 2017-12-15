<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/29/2017
 * Time: 3:23 AM
 */
namespace App\Mail;
use PHPMailer\PHPMailer;
use Slim\Views\Twig;


class Mailer
{
     protected $view;
     protected $mailer;

     public function __construct($view, $mailer)
     {
         $this->view =$view;
         $this->mailer = $mailer;
     }

     public function send($template, $data, $callback)
     {
         $message = new  Message($this->mailer);
         $message->body($this->view->render($template));
         call_user_func($callback, $message);
         $this->mailer->send();

     }
}