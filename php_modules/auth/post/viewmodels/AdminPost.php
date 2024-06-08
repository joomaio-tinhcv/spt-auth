<?php

namespace App\auth\post\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminPost extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>'backend.post.form',
        ];
    }
    
    public function form()
    {
        $data=[];
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;
        $data = $this->PostEntity->findByPK($id);
        $data=$data ? $data : [];
            
        $form = new Form($this->getFormFields(), $data);

        return [
            'id' => $id,
            'form' => $form,
            'link_list' => $this->router->url('posts'),
            'link_form' => $this->router->url('post'),
            'data' => $data,
        ];
        
    }

    public function getFormFields()
    {
        $fields = [
            'title' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Title',
                'formClass' => 'form-control mb-1',
                'required' => 'required',
            ],
            'description' => [
                'textarea',
                'showLabel' => false,
                'placeholder' => 'Description',
                'formClass' => 'form-control',
            ],
            'token' => ['hidden',
                'default' => $this->container->get('token')->value(),
            ],
        ];

        return $fields;
    }
}
