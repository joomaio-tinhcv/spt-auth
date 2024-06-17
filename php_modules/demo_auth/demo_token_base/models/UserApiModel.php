<?php

namespace App\demo_auth\demo_token_base\models;

use SPT\Container\Client as Base; 
use SPT\Traits\ErrorString;

class UserApiModel extends Base 
{ 
    use ErrorString; 

    public function login($username, $passowrd)
    {
        if (!$passowrd || !$passowrd)
        {
            $this->error = 'Username and Password invalid.';
            return false;
        }

        $result = $this->user->login(
            $username,
            $passowrd
        );

        if ( $result )
        {
            return $result;
        }
        else
        {
            $this->error = 'Username or Password Incorrect';
            return false;
        }
    }
}
