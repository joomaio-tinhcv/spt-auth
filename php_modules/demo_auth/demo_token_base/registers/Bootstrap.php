<?php
namespace App\demo_auth\demo_token_base\registers;

use App\demo_auth\demo_token_base\libraries\guards\TokenGuard;
use App\demo_auth\demo_token_base\libraries\providers\UserApiProvider;
use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // init guard
        $user = $app->getContainer()->get('user');
        $session = $app->getContainer()->get('session');
        $request = $app->getContainer()->get('request');
        $UserEntity = $app->getContainer()->get('UserEntity');
        $provider = new UserApiProvider($UserEntity);
        $guard = new TokenGuard('api', $provider, $session, $request);

        $user->registerGuard('api', $guard);
    }
}