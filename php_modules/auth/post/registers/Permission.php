<?php

namespace App\auth\post\registers;

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
