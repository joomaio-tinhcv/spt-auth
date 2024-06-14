<?php

namespace App\auth\google_auth\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'google/login' => [
                'fnc' => [
                    'get' => 'google_auth.google.login',
                ]
            ],
        ];
    }

}
