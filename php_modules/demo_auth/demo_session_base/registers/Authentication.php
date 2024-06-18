<?php
namespace App\demo_auth\demo_session_base\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\demo_auth\demo_session_base\libraries\guards\SessionGuard;
use App\demo_auth\demo_session_base\libraries\providers\UserProvider;

class Authentication
{
    public static function setGuard(IApp $app)
    {
        
    }

    public static function registerGuard(IApp $app)
    {
        $container = $app->getContainer();
        $user = $container->get('user');
        $provider = new UserProvider($container->get('UserEntity'));
        
        $user->registerGuard('web', new SessionGuard('web', $provider, $container->get('session')));

        return true;
    }
}