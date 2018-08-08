<?php

namespace WhosThere\Twitter\Repository;

use WhosThere\Twitter\Entity\Retweet;
use WhosThere\Twitter\Entity\RetweetCollection;
use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\TwitterClientInterface;

class RetweetRepository implements RetweetRepositoryInterface
{
    /**
     * @var TwitterClientInterface
     */
    private $client;

    public function __construct(TwitterClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     *
     * @todo It seems there such a thing as untweeting. Should that affect the reach?
     */
    public function findAllByStatusId($statusId)
    {
        $list = $this->client->getRetweetersList($statusId);

        return new RetweetCollection(array_map(function ($record) {
            return new Retweet(['user_id' => $record['user']['id']]);
        }, $list));
    }
}
