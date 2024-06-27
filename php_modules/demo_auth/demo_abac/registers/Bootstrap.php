<?php
namespace App\demo_auth\demo_abac\registers;

use App\demo_auth\demo_abac\libraries\policies\PostPolicy;
use App\auth\user\libraries\Permission;
use App\auth\user\libraries\policies\AccessKeyPolicy;
use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // add policy
        $container = $app->getContainer();
        $PostPolicy = new PostPolicy($container);
        $container->set('PostPolicy', $PostPolicy);
    }
}