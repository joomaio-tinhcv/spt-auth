<?php

namespace App\demo_auth\demo_session_base\libraries;

use App\demo_auth\demo_session_base\libraries\guards\GuardBase;
use SPT\Container\Client as Base; 

class Authentication extends Base
{
    private $guards;
    private $guard_active; 

    public function getGuard()
    {
        if(!$this->guard_active)
        {
            $this->guard_active = 'web';
        }

        return isset($this->guards[$this->guard_active]) ? $this->guards[$this->guard_active] : null;
    }

    public function setGuard($guard)
    {
        $this->guard_active = $guard;
        $guard = $this->getGuard();
        $this->data = !is_null($guard) ? $guard->user() : null;
        return ;
    }

    public function registerGuard($key, GuardBase $guard)
    {
        if(!isset($this->guards[$key]))
        {
            $this->guards[$key] = $guard;
        }

        return true;
    }

    /**
     * Login with supplied username and password
     * TODO apply middleware or authentication
     *
     * @param string   $username 
     * @param string   $password 
     * 
     * @return bool|User
     */ 
    public function login(string $username, string $password)
    {
        $guard = $this->getGuard();
        $try = $guard ? $guard->login($username, $password) : false;
        return $try;
    }

    public function user()
    {
        $guard = $this->getGuard();
        $try = $guard ? $guard->user() : false;
        return $try;
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $try = $guard ? $guard->logout() : parent::logout();
        
        return ;
    }

    public function can()
    {
        return true;
    }

    public function get($key, $default = null)
    {
        $user = $this->user();
        if($user && isset($user[$key]))
        {
            return $user[$key];
        }

        return $default;
    }
}
