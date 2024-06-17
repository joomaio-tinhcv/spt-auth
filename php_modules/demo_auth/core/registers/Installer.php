<?php
namespace App\demo_auth\core\registers;

use SPT\Application\IApp;

class Installer
{
    public static function name()
    {
        return 'Plugin core';
    }

    public static function info()
    {
        return [
            'author' => 'Pham Minh',
            'created_at' => '2023-01-03',
            'description' => 'Plugin used to for core bootstrap',
            'tags' => ['sdm']
        ];
    }

    public static function version()
    {
        return '0.0.1';
    }

    public static function install( IApp $app)
    {
        // run sth to prepare the install
    }
    public static function uninstall( IApp $app)
    {
        // run sth to uninstall
    }
    public static function active( IApp $app)
    {
        // run sth to prepare the install
    }
    public static function deactive( IApp $app)
    {
        // run sth to uninstall
    }
}