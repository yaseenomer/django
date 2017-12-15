<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 7:37 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $fillable =
        ['name', 'email','password' ];

    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }


}
