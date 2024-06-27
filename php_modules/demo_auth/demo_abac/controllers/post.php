<?php

namespace App\demo_auth\demo_abac\controllers;

use SPT\Web\ControllerMVVM;

class post extends ControllerMVVM
{
    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.post.list');
    }

    public function detail()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.post.form');
    }

    public function add()
    {
        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'description' => $this->request->post->get('description', '', 'string'),
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $try = $this->PostModel->add($data);

        $message = $try ? 'Create Successfully!' : 'Error: '. $this->PostModel->getError();

        $this->session->set('flashMsg', $message);
        return $this->app->redirect(
            $this->router->url($try ? 'posts' : 'post/0')
        );
    }

    public function update()
    {
        $id = $this->validateID(); 

        if(is_numeric($id) && $id)
        {
            $data = [
                'title' => $this->request->post->get('name', '', 'string'),
                'description' => $this->request->post->get('description', '', 'string'),
                'created_by' => $this->user->get('id'),
                'created_at' => date('Y-m-d H:i:s'),
                'id' => $id,
            ];
        
            $try = $this->PostModel->update($data);
            $message = $try ? 'Update Successfully!' : 'Error: '. $this->PostModel->getError();
            
            $this->session->set('flashMsg', $message);
            return $this->app->redirect(
                $this->router->url($try ? 'posts' : 'post/'. $id)
            );
        }

        $this->session->set('flashMsg', 'Error: Invalid Task!');
        return $this->app->redirect(
            $this->router->url('posts')
        );
    }

    public function delete()
    {
        $ids = $this->validateID();
        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->PostModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->PostModel->remove($ids ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('posts'), 
        );
    }

    public function validateID()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Post');
            return $this->app->redirect(
                $this->router->url('posts'),
            );
        }

        return $id;
    }
}