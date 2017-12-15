<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 11:03 AM
 */
namespace App\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordException extends ValidationException
{
    public static $defaultTemplates =
        [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Password does not match .',
            ]

        ];
}