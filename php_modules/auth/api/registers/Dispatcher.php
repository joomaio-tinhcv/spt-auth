<?php
namespace App\auth\api\registers;

use SPT\Application\IApp;
use SPT\Response;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $cName = $app->get('controller');
        $fName = $app->get('function');
        $user = $app->getContainer()->get('user');
        $user->setGuard('api');
        if (!$user->get('id'))
        {
            $app->raiseError('Invalid controller '. $cName);
        }
        $controller = 'App\auth\api\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app->getContainer());
        $controller->{$fName}();

        $app->set('theme', $app->cf('adminTheme'));

        $fName = 'to'. ucfirst($app->get('format', 'html')); 

        if(empty( $app->get('theme', '') ))
        {
            $app->set('theme', $app->cf('defaultTheme'));
        }

        $app->finalize(
            $controller->{$fName}()
        );
    }
}