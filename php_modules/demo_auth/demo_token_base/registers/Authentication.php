<?php
namespace App\demo_auth\demo_token_base\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\demo_auth\demo_token_base\libraries\guards\TokenGuard;
use App\demo_auth\demo_token_base\libraries\providers\UserApiProvider;

class Authentication
{
    public static function setGuard(IApp $app)
    {
        $fName = $app->get('function');
        $user = $app->getContainer()->get('user');
        $user->setGuard('api');
        if (!$user->get('id') && $fName != 'login')
        {
            return $app->raiseError('Unauthorized', 401);
        }

        return true;
    }

    public static function registerGuard(IApp $app)
    {
        $container = $app->getContainer();
        $user = $container->get('user');
        $provider = new UserApiProvider($container->get('UserEntity'));
        
        $user->registerGuard('api', new TokenGuard('api', $provider, $container->get('session'), $container->get('request')));

        return true;
    }
}