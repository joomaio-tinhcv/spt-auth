<?php
namespace App\demo_auth\demo_session_base\registers;

use App\demo_auth\demo_session_base\libraries\Authentication;
use App\demo_auth\demo_session_base\libraries\Permission;
use App\demo_auth\demo_session_base\libraries\policies\AccessKeyPolicy;
use SPT\Application\IApp;

class Bootstrap
{
    public static function initialize( IApp $app)
    {
        // init authentication
        $container = $app->getContainer();
        $authentication = new Authentication($container);
        $container->set('authentication', $authentication);
    }
}