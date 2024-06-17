<?php

namespace App\demo_auth\user\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'user_manager', 'user_read', 'user_create', 'user_update', 'user_delete', 'user_profile',
            'usergroup_manager', 'usergroup_read', 'usergroup_create', 'usergroup_update', 'usergroup_delete'
        ];
    }
    
    public static function CheckSession(IApp $app)
    {
        $user = $app->getContainer()->get('user');
        $permission = $app->getContainer()->get('permission');

        if( is_object($user) && $user->get('id') )
        {
            $request_permission = $app->get('permission', []);
            if(!$request_permission)
            {
                return true;
            }

            $method = $app->getContainer()->get('request')->header->getRequestMethod();
            foreach($request_permission as $gate => $params)
            {
                $param = is_array($params) ? $params[$method] : $params;
                $try = $permission->can($gate, $param);
                if($try)
                {
                    return true;
                }
            }
            
            $app->raiseError('You do not have access', 403);
        } 

        $app->redirect(
            $app->getRouter()->url('login')
        );
    }
}
