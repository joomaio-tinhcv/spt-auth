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
        $authentication = $app->getContainer()->get('authentication');
        $authentication->setGuard('api');
        if (!$authentication->get('id') && $fName != 'login')
        {
            return $app->raiseError('Unauthorized', 401);
        }

        return true;
    }

    public static function registerGuard(IApp $app)
    {
        $container = $app->getContainer();
        $authentication = $container->get('authentication');
        $provider = new UserApiProvider($container->get('UserEntity'));
        
        $authentication->registerGuard('api', new TokenGuard('api', $provider, $container->get('session'), $container->get('request')));

        return true;
    }
}