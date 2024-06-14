<?php
/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic viewmodel
 * 
 */
namespace App\auth\core\viewmodels; 

use SPT\Web\ViewModel;

class GoolgeLogin extends ViewModel
{
    public static function register()
    {
        return [
            'widget' => [
                'google_login',
            ]
        ];
    }

    public function google_login()
    {
        $link_google = $this->GoogleAuthModel->getUrlLogin();
        return [
            'link_google' => $link_google,
        ];
    }
}
