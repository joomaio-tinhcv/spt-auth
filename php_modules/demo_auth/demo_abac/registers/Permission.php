<?php

namespace App\demo_auth\demo_abac\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'post_manager', 'post_creator'
        ];
    }
}
