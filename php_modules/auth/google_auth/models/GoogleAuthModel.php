<?php

namespace App\auth\google_auth\models;

use SPT\Container\Client as Base; 
use SPT\Traits\ErrorString;

class GoogleAuthModel extends Base 
{ 
    // Write your code here
    public function getUrlLogin()
    {
        $client = $this->initGoogle();
        if ($client)
        {
            $url = $client->createAuthUrl();

            return $url;
        }
        
        return '';
    }

    public function initGoogle()
    {
        $client = new \Google_Client();
        $google_client_id = $this->config->google_client_id ?? '';
        $google_client_secrect = $this->config->$this->google_client_secrect ?? '';
        if ($google_client_id && $google_client_secrect)
        {
            $client->setClientId($google_client_id);
            $client->setClientSecret($google_client_secrect);
            $client->setRedirectUri($this->router->url('google_auth'));
            $client->addScope("email");
            $client->addScope("profile");
                
        }
        else{
            return false;
        }
        
        return $client;
    }
}
