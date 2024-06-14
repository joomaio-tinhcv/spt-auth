<?php

namespace App\auth\oauth2\libraries\guards;

use App\auth\user\libraries\providers\ProviderBase;
use App\auth\user\libraries\guards\Guard;
use SPT\User\SPT\User as UserBase;
use SPT\Traits\ErrorString;
use SPT\Session\Instance as Session;
use SPT\Request\Base as Request;

class TokenGuard implements Guard
{
    protected $user;
    protected $name;
    protected $provider;
    protected $session;
    protected $request;

    public function __construct($name,
                                ProviderBase $provider,
                                Session $session, 
                                Request $request)
    {
        $this->name = $name;
        $this->session = $session;
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getName()
    {
        return 'login_'.$this->name;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return !(is_null($this->user()) || !$this->user()['id']);
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     */
    public function user()
    {
        if (! is_null($this->user)) {
            return $this->user;
        }

        // find user by token
        $access_token = $this->request->get->get('access_token', '', 'string');
        if(empty($access_token))
        {
            $access_token = $this->request->post->get('access_token', '', 'string');
        }

        $this->user = $this->provider->retrieveByToken($id, $access_token);
        if($this->user)
        {
            unset($this->user['password']);
        }

        return $this->user;
    }

    /**
     * Get the currently authenticated user.
     */
    public function login($username, $password)
    {
        $user = $this->provider->retrieveByCredentials(['username' => $username,'password' => $password]);
        if($user)
        {
            unset($user['password']);
            $this->user = $user;

            // generate string and expired time
            $token = $this->provider->generateToken($this->user['id']);
            
            return $token;
        }

        return false;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id()
    {
        return $this->user() ? $this->user()->id : null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // Todo
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser()
    {
        // Todo
    }

    /**
     * Set the current user.
     *
     */
    public function setUser($user)
    {
        $this->user = $user;
        return;
    }
}
