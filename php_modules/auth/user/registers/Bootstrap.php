<?php
namespace App\auth\user\registers;

use App\auth\user\libraries\Permission;
use App\auth\user\libraries\policies\AccessKeyPolicy;
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