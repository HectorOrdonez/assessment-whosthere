<?php

namespace WhosThere\Twitter\Entity;

class Retweet
{
    private $userId;

    public function __construct(array $params = [])
    {
        if (isset($params['user_id'])) {
            $this->userId = $params['user_id'];
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
