<?php

namespace App\demo_auth\demo_abac\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'posts' => [
                'fnc' => [
                    'get' => 'demo_abac.post.list',
                    'post' => 'demo_abac.post.list',
                    'delete' => 'demo_abac.post.delete',
                ],
                'permission' => [
                    'access_key' => [
                        'get' => ['post_manager', 'post_creator'],
                        'post' => ['post_manager', 'post_creator'],
                        'delete' => ['post_manager']
                    ],
                ],
            ],
            'post' => [
                'fnc' => [
                    'get' => 'demo_abac.post.detail',
                    'post' => 'demo_abac.post.add',
                    'put' => 'demo_abac.post.update',
                    'delete' => 'demo_abac.post.delete'
                ],
                'parameters' => ['id'],
                'permission' => [
                    'access_key' => [
                        'get' => ['post_manager'],
                        'post' => ['post_manager'],
                        'put' => ['post_manager'],
                        'delete' => ['post_manager']
                    ],
                    'post_policy' => [
                        'get' => 'detail',
                        'post' => 'update',
                        'put' => 'update',
                        'delete' => 'delete',
                    ]
                ],
            ],
        ];
    }

    public static function afterRouting(IApp $app)
    {
        $permission = $app->getContainer()->get('permission');
        if($permission)
        {
            $permission->extendGate('post_policy', 'PostPolicy', 'allow');
        }

        return true;
    }
}
