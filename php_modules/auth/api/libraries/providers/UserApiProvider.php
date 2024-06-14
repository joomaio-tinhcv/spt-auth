<?php

namespace App\auth\api\libraries\providers;

use App\auth\user\libraries\providers\ProviderBase;
use SPT\Storage\DB\Entity;

class UserApiProvider implements ProviderBase
{
    protected $entity;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $id
     */
    public function retrieveById($id)
    {
        $user = $this->entity->findByPK($id);
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $id
     * @param  string  $token
     */
    public function retrieveByToken($id, $access_token)
    {
        $user = $this->entity->findOne(['access_token' => md5($access_token)]);
        if($user)
        {
            if (strtotime('now') > strtotime($user['token_expired']))
            {
                return false;
            }
        }
        
        return $user;
    }

    

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     */
    public function retrieveByCredentials(array $credentials)
    {
        $username = $credentials['username'] ?? '';
        $password = $credentials['password'] ?? '';
        $user = $this->entity->findOne(['username' => $username, 'password'=> md5($password)]);
        
        return $user;
    }


    public function generateToken($id)
    {
        $token = $this->generateRandomString();
        $find = $this->entity->findByPK($id);
        if(!$find)
        {
            return false;
        }

        $find['access_token'] = md5($token);
        $find['token_expired'] = date('y-m-d h:i:s', strtotime('now +5 minutes'));
        $find['password'] = '';
        $try = $this->entity->update($find);

        return $try ? $token : false;
    }

    public function generateRandomString($length = 15) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) 
        {
            $randomIndex = random_int(0, $charactersLength - 1);
            $randomString .= $characters[$randomIndex];
        }
        
        return $randomString;
    }
}
