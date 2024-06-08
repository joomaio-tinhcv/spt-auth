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

class Message extends ViewModel
{
    public static function register()
    {
        return [
            'widget' => [
                'message|render',
                'notification|render'
            ]
        ];
    }

    public function render()
    {
        $message = $this->session->get('flashMsg', '');
        $message = is_array($message) ? implode('<br>', $message) : $message;
        $this->session->set('flashMsg', '');
        return [
            'message' => $message,
        ];
    }
}
