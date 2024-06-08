<?php
namespace App\auth\post\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerItem( IApp $app )
    {
        $container = $app->getContainer();
        $router = $container->get('router');
        $path_current = $router->get('actualPath');
        $permission = $container->exists('permission') ? $container->get('permission') : null;

        $allow = $permission ? $permission->can('access_key', ['post_manager', 'post_creator']) : true;
        
        if($allow)
        {
            $active = strpos($path_current, 'post') !== false ? 'active' : '';
            $menu[] = [
                'link' => $router->url('posts'),
                'title' => 'Posts', 
                'icon' => '<i class="fa-solid fa-file"></i>', 
                'class' => $active,
            ];
        }
        
        
        return [
            'menu' => $menu,
            'order' => 3,
        ];
    }
}