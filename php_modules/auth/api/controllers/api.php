<?php namespace App\auth\api\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class api extends ControllerMVVM 
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

}