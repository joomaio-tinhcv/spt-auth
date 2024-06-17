<?php

namespace App\demo_auth\demo_token_base\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'api/auth' => [
                'fnc' => [
                    'post' => 'demo_token_base.api.login',
                ],
                'format' => 'json',
            ],
            'api/users' => [
                'fnc' => [
                    'get' => 'demo_token_base.api.list',
                ],
                'format' => 'json',
            ],
            'api/user' => [
                'fnc' => [
                    'get' => 'demo_token_base.api.detail',
                ],
                'format' => 'json',
                'parameters' => ['id'],
            ],
        ];
    }
}
