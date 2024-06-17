<?php
namespace App\demo_auth\demo_session_base\registers;

use App\demo_auth\demo_session_base\libraries\Permission;
use App\demo_auth\demo_session_base\libraries\policies\AccessKeyPolicy;
use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // load permission lib
        $container = $app->getContainer();
        $permission = new Permission($container);
        $container->set('permission', $permission);

        // add policy
        $AccessKeyPolicy = new AccessKeyPolicy($container);
        $container->set('AccessKeyPolicy', $AccessKeyPolicy);
    }
}