<?php

namespace App\auth\google_auth\viewmodels; 

use SPT\Web\ViewModel;

class GoogleLogin extends ViewModel
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
