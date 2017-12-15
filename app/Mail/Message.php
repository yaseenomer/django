<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/29/2017
 * Time: 3:46 AM
 */

namespace App\Mail;

class Message
{

    protected $mailer;



    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function to($address)
    {
        $this->mailer->addAddress($address);
    }

    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function body($body)
    {
        $this->mailer->Body = $body;
    }
}