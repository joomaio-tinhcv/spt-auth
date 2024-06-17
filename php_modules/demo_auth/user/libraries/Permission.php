<?php

namespace App\demo_auth\user\libraries;

use SPT\Container\Client as Base;
use SPT\Traits\ErrorString;

class Permission extends Base
{
    protected $gates;
    use ErrorString; 

    public function can(string $gate, ... $params)
    {
        if(!isset($this->gates[$gate]))
        {
            return false;
        }

        $config = $this->gates[$gate];

        if(!$config || !$config['class'] || !$config['fnc'])
        {
            return false;
        }

        if(!$this->container->exists($config['class']))
        {
            return false;
        }

        $policy = $this->container->get($config['class']);
        $try = false;
        if(method_exists($policy, $config['fnc']))
        {
            $try = $policy->{$config['fnc']}(...$params);
        }

        return $try;
    }

    public function extendGate(string $gate, string $class, string $fnc)
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
