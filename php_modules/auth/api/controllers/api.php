<?php namespace App\auth\api\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class api extends ControllerMVVM 
{
    public function detail()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $existUser = $this->UserEntity->findByPK($id);
        if(!empty($id) && !$existUser) 
        {
            $this->session->set('flashMsg', "Invalid user");
            return $this->app->redirect(
                $this->router->url('users')
            );
        }

        $this->app->set('layout', 'backend.user.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.user.list');
    }

}