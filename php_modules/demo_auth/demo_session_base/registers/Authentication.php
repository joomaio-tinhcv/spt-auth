<?php
namespace App\demo_auth\demo_session_base\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\demo_auth\demo_session_base\libraries\guards\SessionGuard;
use App\demo_auth\demo_session_base\libraries\providers\UserProvider;

class Authentication
{
    public static function onLoad(IApp $app)
    {
        // load all registerGuard
        $app->plgLoad('authentication', 'registerGuard');
        // run authentication in active plugin
        $plugin = $app->get('mainPlugin', '');
        
        if($plugin)
        {
            $app->mainLoad('authentication', 'setGuard');
        }
        
        // run check permission in request
        // Todo
        // $user = $app->getContainer()->get('user');
        // $try = $user->can($app->getContainer()->get('request'));
        // if(!$try)
        // {
        //     return $app->raiseError('Unauthorized', 401);
        
        // }

        return true;
    }

    public static function registerGuard(IApp $app)
    {
        $container = $app->getContainer();
        $authentication = $container->get('authentication');
        $provider = new UserProvider($container->get('UserEntity'));
        
        $authentication->registerGuard('web', new SessionGuard('web', $provider, $container->get('session')));
        return true;
    }
}