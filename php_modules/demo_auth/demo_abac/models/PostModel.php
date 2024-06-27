<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\demo_auth\demo_abac\models;

use SPT\Container\Client as Base;

class PostModel extends Base
{ 
    // Write your code here
    use \SPT\Traits\ErrorString;

    public function remove($id)
    {
        if(!$id)
        {
            return false;
        }

        return $this->PostEntity->remove($id);
    }

    public function add($data)
    {
        $data = $this->PostEntity->bind($data);

        if (!$data || !isset($data['readyNew']) || !$data['readyNew'])
        {
            $this->error = $this->PostEntity->getError();
            return false;
        }
        unset($data['readyNew']);

        $newId =  $this->PostEntity->add($data);

        if (!$newId)
        {
            $this->error = $this->PostEntity->getError();
            return false;
        }

        return $newId;
    }

    public function update($data)
    {
        $data = $this->PostEntity->bind($data);

        if (!$data || !isset($data['readyUpdate']) || !$data['readyUpdate'])
        {
            $this->error = $this->PostEntity->getError();
            return false;
        }
        unset($data['readyUpdate']);

        $try = $this->PostEntity->update($data);
        if (!$try)
        {
            $this->error = $this->PostEntity->getError();
            return false;
        }

        return $try;
    }
    
}
