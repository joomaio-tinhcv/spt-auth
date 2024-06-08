<?php

namespace App\auth\user\libraries\policies;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class AccessKeyPolicy extends Base
{
    use ErrorString; 

    public function getAccess()
    {
        if (!$this->get('access')) 
        {
            $register_access = [];
            $this->app->plgLoad('permission', 'registerAccess', function($access) use (&$register_access){
                if (is_array($access) && $access)
                {
                    $register_access = array_merge($register_access, $access);
                }
            });
    
            $this->set('access', $register_access);
        }
        return $this->get('access');
    }

    public function getAccessGroup()
    {
        $access = [];
        $result = $this->app->plgLoad('permission', 'registerAccess', null, true);
        
        foreach($result as $key => $item)
        {
            $access[$key] = $item['result'];
        }

        return $access;
    }

    public function allow($permission)
    {
        if (!$permission)
        {
            return true;
            
        }
        
        $user_access = $this->getAccessByUser();
        if(is_string($permission))
        {
            if (in_array($permission, $user_access))
            {
                return true;
            }
        }
        else
        {
            foreach($permission as $item)
            {
                if (in_array($item, $user_access))
                {
                    return true;
                }
            }
        }

        return false;
    }

    public function getAccessByUser()
    {
        if (!$this->user->get('id'))
        {
            return [];
        }

        $groups = $this->UserEntity->getGroups($this->user->get('id'));
        $access = [];

        foreach($groups as $group)
        {
            $group_tmp = $this->GroupEntity->findByPK($group['group_id']);
            if ($group_tmp)
            {
                $access_tmp = $group_tmp['access'] ? json_decode($group_tmp['access'], true) : [];
                $access = array_merge($access, $access_tmp);
            }
        }

        return $access;
    }
}
