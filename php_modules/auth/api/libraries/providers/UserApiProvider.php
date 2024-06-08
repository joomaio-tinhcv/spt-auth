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
    public function retrieveByToken($id, $token)
    {
        // todo
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     */
    public function retrieveByCredentials(array $credentials)
    {
        $access_token = $credentials['access_token'] ?? '';
        $user = $this->entity->findOne(['access_token' => $access_token]);
        
        return $user;
    }
}
