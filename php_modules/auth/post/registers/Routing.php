<?php

namespace App\auth\post\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'posts' => [
                'fnc' => [
                    'get' => 'post.post.list',
                    'post' => 'post.post.list',
                    'delete' => 'post.post.delete',
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
                    'get' => 'post.post.detail',
                    'post' => 'post.post.add',
                    'put' => 'post.post.update',
                    'delete' => 'post.post.delete'
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
                        'get' => ['detail'],
                        'post' => ['create'],
                        'put' => ['update'],
                        'delete' => ['delete'],
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
