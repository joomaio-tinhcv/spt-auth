<?php namespace App\auth\google_auth\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class google extends ControllerMVVM 
{
    public function login()
    {
        $client = $this->GoogleModel->initGoogle();
        $code = $this->request->get->get('code', '', 'string');
        if ($code) 
        {
            $token = $client->fetchAccessTokenWithAuthCode($code);
            if (!isset($token['access_token']))
            {
                $this->session->set('flashMsg', 'Login Fail');
                return $this->app->redirect($this->router->url('login'));
            }
            $client->setAccessToken($token['access_token']);
     
            // get profile info
            $google_oauth = new \Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;

           /**
            * CHECK EMAIL AND NAME IN DATABASE
            */
            $check = $this->UserEntity->findOne(['email' => $email]);
            if (!$check)
            {
                $this->session->set('flashMsg', 'Login failed, email not registered');
                return $this->app->redirect($this->router->url('login'));
            }
            else
            {
                $user_id = $check['id'];
            }

            $user = $this->UserEntity->findOne(['id' => $user_id]);
            $storate = $this->user->getContext();
            $this->session->set($storate, $user);
            
            return $this->app->redirect($this->router->url(''));
        }
        
        return $this->app->redirect($this->router->url('login'));
    }

}