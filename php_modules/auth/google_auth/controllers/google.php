<?php namespace App\auth\google_auth\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class google extends ControllerMVVM 
{
    public function detail()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $user = $this->UserEntity->findByPK($id);
        if($user)
        {
            $this->set('user', $user);
        }
        else
        {
            $this->set('message', 'Invalid user');
        }
        $this->set('status', $user ? 'success' : 'fail');
        return;
    }

    public function list()
    {
        $users = $this->UserEntity->list(0,0);
        $this->set('status', 'success');
        $this->set('users', $users);
        return;
    }

    public function login()
    {
        $try = $this->UserApiModel->login(
            $this->request->post->get('username', '', 'string'),
            $this->request->post->get('password', '', 'string')
        );

        if(!$try)
        {
            $this->set('error',  'Invalid Username or Password');
        }
        
        $this->set('status', $try ? 'success' : 'fail');
        $this->set('access_token', $try ? $try : '');
        return;
    }

}