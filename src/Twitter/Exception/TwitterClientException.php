<?php

namespace WhosThere\Twitter\Exception;

class TwitterClientException extends \Exception
{
    public function __construct(array $errors)
    {
        parent::__construct('TwitterClient complained: ' . $errors[0]->message);
    }
}
