<?php

namespace App\demo_auth\demo_session_base\libraries;

use App\demo_auth\demo_session_base\libraries\guards\Guard;
use App\demo_auth\demo_session_base\libraries\guards\SessionGuard;
use App\demo_auth\demo_session_base\libraries\providers\UserProvider;
use SPT\User\SPT\User as UserBase;
use SPT\Traits\ErrorString;

class User extends UserBase
{
    protected $guard_active;
    protected $guards;
    protected $gates;

    public function init(array $options)
    {
        parent::init($options);

        if (!isset($options['guards']))
        {
            $provider = new UserProvider($this->entity);
            $this->guards = [
                'web' => new SessionGuard('web', $provider, $this->session)
            ];
        }
        elseif(is_array($options['guards']))
        {
            $this->guards = [];
            foreach($options['guards'] as $key => $item)
            {
                $this->guards[$key] = $item;
            }
        }
        
        $guard = $this->getGuard();
        $this->data = !is_null($guard) ? $guard->user() : null;
        
        if( empty($this->data) )
        {
            $this->data = $this->getDefault();
        }

    }

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

    public function extendGuard($key, Guard $guard)
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
        $try = $guard ? $guard->login($username, $password) : parent::login($username, $password);
        return $try;
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $try = $guard ? $guard->logout() : parent::logout();
        
        return ;
    }

    public function can(string $gate, ... $params)
    {
        if(!isset($this->gates[$gate]))
        {
            return false;
        }

        $config = $this->gates[$gate];

        return true;
    }

    public function registerGates(string $gate, string $class, string $fnc)
    {
        if(is_null($this->gates))
        {
            $this->gates = [];
        }

        $this->gates[$gate] = [
            'class' => $class,
            'fnc' => $fnc,
        ];

        return true;
    }
}