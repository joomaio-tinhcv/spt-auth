<?php

namespace App\demo_auth\demo_abac\libraries\policies;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class PostPolicy extends Base
{
    use ErrorString; 

    public function allow($action, $post_id = null)
    {
        $try = false;
        if(method_exists($this, $action))
        {
            if(empty($post_id))
            {
                $urlVars = $this->request->get('urlVars');
                $post_id = $urlVars ? (int) $urlVars['id'] : [];
            }
            $try = $this->{$action}($post_id);
        }

        return $try;
    }

    public function detail($post_id)
    {
        if(!$post_id)
        {
            return true;
        }

        $user_id = $this->user->get('id');
        $post = $this->PostEntity->findByPK($post_id);

        if(!$post)
        {
            return false;
        }

        if($post['created_by'] == $user_id)
        {
            return true;
        }

        return false;
    }

    public function update($post_id)
    {
        if(!$post_id)
        {
            return false;
        }

        $user_id = $this->user->get('id');
        $post = $this->PostEntity->findByPK($post_id);

        if(!$post)
        {
            return false;
        }

        if($post['created_by'] == $user_id)
        {
            return true;
        }

        return false;
    }

    public function delete($post_id)
    {
        if(!$post_id)
        {
            return false;
        }

        $user_id = $this->user->get('id');
        $post = $this->PostEntity->findByPK($post_id);

        if(!$post)
        {
            return false;
        }

        if($post['created_by'] == $user_id)
        {
            return true;
        }

        return false;
    }

    public function create($post_id)
    {
        if(!$post_id)
        {
            return true;
        }

        $post = $this->PostEntity->findByPK($post_id);

        if(!$post)
        {
            return false;
        }
    }
}
