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
        $list = $this->client->getFollowersList($userId);

        return new FollowerCollection(array_map(function ($record) {
            return new Follower($record);
        }, $list));
    }
}
