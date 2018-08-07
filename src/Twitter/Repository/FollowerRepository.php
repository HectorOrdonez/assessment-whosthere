<?php

namespace WhosThere\Twitter\Repository;

use WhosThere\Twitter\Entity\Follower;
use WhosThere\Twitter\Entity\FollowerCollection;
use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\Twitter\TwitterClientInterface;

class FollowerRepository implements FollowerRepositoryInterface
{
    /**
     * @var TwitterClientInterface
     */
    private $client;

    public function __construct(TwitterClientInterface $client)
    {
        $this->client = $client;
    }

    public function findAllByUserId($userId)
    {
        $followerCollection = new FollowerCollection();
        $list = $this->client->getFollowersList($userId);

        foreach($list as $record)
        {
            $follower = new Follower();
            $follower->setId($record['id']);

            $followerCollection[] = $follower;
        }

        return $followerCollection;
    }
}
