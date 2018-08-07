<?php

namespace WhosThere\Twitter;

interface TwitterClientInterface
{
    public function placeholder($string);

    /**
     * Gets a list of followers for given user id
     *
     * @todo Twitter has limits for this kind of requests. A proper approach would require pagination
     * @param $userId
     * @return array
     */
    public function getFollowersList($userId);

    /**
     * Gets a list of retweets for given status id
     *
     * @todo This gives the most recent 100 retweets. This also requires pagination
     * @param int $statusId
     * @return array
     */
    public function getRetweetsList($statusId);
}
