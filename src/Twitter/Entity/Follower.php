<?php

namespace WhosThere\Twitter\Entity;

class Follower
{
    private $id;

    public function __construct(array $params = [])
    {
        if(isset($params['id']))
        {
            $this->id = $params['id'];
        }
    }
}
