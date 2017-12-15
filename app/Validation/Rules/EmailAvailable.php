<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 10:51 AM
 */



namespace App\Validation\Rules;


use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{

   public function validate($input)
   {
      return User::where('email',$input)->count()===0;
   }

}