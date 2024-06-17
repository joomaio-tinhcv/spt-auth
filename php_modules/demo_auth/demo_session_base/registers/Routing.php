<?php

namespace App\demo_auth\demo_session_base\registers;

use SPT\Application\IApp;

class Routing
{
    public static function registerEndpoints()
    {
        return [
            'login' => [
                'fnc' => [
                    'get' => 'demo_session_base.user.gate',
                    'post' => 'demo_session_base.user.login',
                ]
            ],
            'logout' => 'demo_session_base.user.logout',

            // Endpoint User
            'users' => [
                'fnc' => [
                    'get' => 'demo_session_base.user.list',
                    'post' => 'demo_session_base.user.list',
                    'put' => 'demo_session_base.user.update',
                    'delete' => 'demo_session_base.user.delete'
                ],
                // 'permission' => [
                //     'access_key' => [
                //         'get' => ['user_manager', 'user_read'],
                //         'post' => ['user_manager', 'user_read'],
                //         'put' => ['user_manager', 'user_update'],
                //         'delete' => ['user_manager', 'user_delete'],
                //     ]
                // ],
            ],
            'profile' => [
                'fnc' => [
                    'get' => 'demo_session_base.user.profile',
                    'post' => 'demo_session_base.user.saveProfile',
                ],
            ],
            'user' => [
                'fnc' => [
                    'get' => 'demo_session_base.user.detail',
                    'post' => 'demo_session_base.user.add',
                    'put' => 'demo_session_base.user.update',
                    'delete' => 'demo_session_base.user.delete'
                ],
                'parameters' => ['id'],
                // 'permission' => [
                //     'access_key' => [
                //         'get' => ['user_manager', 'user_read'],
                //         'post' => ['user_manager', 'user_create'],
                //         'put' => ['user_manager', 'user_update'],
                //         'delete' => ['user_manager', 'user_delete']
                //     ],
                // ],
            ],
            'user-groups' => [
                'fnc' => [
                    'get' => 'demo_session_base.usergroup.list',
                    'post' => 'demo_session_base.usergroup.list',
                    'put' => 'demo_session_base.usergroup.update',
                    'delete' => 'demo_session_base.usergroup.delete'
                ],
                // 'permission' => [
                //     'access_key' => [
                //         'get' => ['usergroup_manager', 'usergroup_read'],
                //         'post' => ['usergroup_manager', 'usergroup_read'],
                //         'put' => ['usergroup_manager', 'usergroup_update'],
                //         'delete' => ['usergroup_manager', 'usergroup_delete']
                //     ],
                // ],
            ],

            'user-group' => [
                'fnc' => [
                    'get' => 'demo_session_base.usergroup.detail',
                    'post' => 'demo_session_base.usergroup.add',
                    'put' => 'demo_session_base.usergroup.update',
                    'delete' => 'demo_session_base.usergroup.delete'
                ],
                'parameters' => ['id'],
                // 'permission' => [
                //     'access_key' => [
                //         'get' => ['usergroup_manager', 'usergroup_read'],
                //         'post' => ['usergroup_manager', 'usergroup_create'],
                //         'put' => ['usergroup_manager', 'usergroup_update'],
                //         'delete' => ['usergroup_manager', 'usergroup_delete']
                //     ],
                // ],
            ],
        ];
    }

    // public static function afterRouting(IApp $app)
    // {
    //     $permission = $app->getContainer()->get('permission');
    //     if($permission)
    //     {
    //         $permission->extendGate('access_key', 'AccessKeyPolicy', 'allow');
    //     }

    //     return true;
    // }
}
