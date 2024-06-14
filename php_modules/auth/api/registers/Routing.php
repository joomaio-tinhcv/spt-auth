<?php

namespace App\auth\api\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'api/auth' => [
                'fnc' => [
                    'post' => 'api.api.login',
                ],
                'format' => 'json',
            ],
            'api/users' => [
                'fnc' => [
                    'get' => 'api.api.list',
                ],
                'format' => 'json',
            ],
            'api/user' => [
                'fnc' => [
                    'get' => 'api.api.detail',
                ],
                'format' => 'json',
                'parameters' => ['id'],
            ],
        ];
    }
}
