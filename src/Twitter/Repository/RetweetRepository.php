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
        $retweetCollection = new RetweetCollection();

        $list = $this->client->getRetweetsList($statusId);

        foreach ($list as $record) {
            $retweet = new Retweet(['user_id' => $record['user']['id']]);

            $retweetCollection[] = $retweet;
        }

        return $retweetCollection;
    }
}
