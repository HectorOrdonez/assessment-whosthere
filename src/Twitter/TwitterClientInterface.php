<?php

namespace WhosThere\Twitter;

interface TwitterClientInterface
{
    public function placeholder($string);

    /**
     * Gets a list of follower ids for given user id
     *
     * @todo Twitter has limits for this kind of requests. A proper approach would require pagination
     * @param $userId
     * @return array
     */
    public function getFollowersList($userId);
}
