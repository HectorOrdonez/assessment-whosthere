<?php

namespace WhosThere\ReachCalculator\Service;

use WhosThere\Twitter\Entity\RetweetCollection;
use WhosThere\Twitter\Entity\FollowerCollection;
use WhosThere\Twitter\RetweetRepositoryInterface;
use WhosThere\Twitter\FollowerRepositoryInterface;
use WhosThere\ReachCalculator\ReachCalculatorServiceInterface;

class ReachCalculator implements ReachCalculatorServiceInterface
{
    /**
     * @var RetweetRepositoryInterface
     */
    private $retweetRepository;

    /**
     * @var FollowerRepositoryInterface
     */
    private $followerRepository;

    /**
     * ReachCalculator constructor.
     * @param RetweetRepositoryInterface $retweetRepository
     * @param FollowerRepositoryInterface $followerRepository
     */
    public function __construct(
        RetweetRepositoryInterface $retweetRepository,
        FollowerRepositoryInterface $followerRepository
    ) {
        $this->retweetRepository = $retweetRepository;
        $this->followerRepository = $followerRepository;
    }

    /**
     * @inheritdoc
     */
    public function calculate($url)
    {
        $statusId = $this->getStatusIdFromUrl($url);

        $retweeters = $this->getRetweeters($statusId);

        $followers = $this->getFollowers($retweeters);

        return count($retweeters) + count($followers);
    }

    /**
     * @param int $statusId
     * @return RetweetCollection
     */
    private function getRetweeters($statusId)
    {
        return $this->retweetRepository->findAllByStatusId($statusId);
    }

    private function getFollowers(RetweetCollection $retweeters)
    {
        $followers = new FollowerCollection();

        foreach($retweeters as $retweet)
        {
            // @todo check if the followers are repeating
            $newFollowers = $this->followerRepository->findAllByUserId($retweet->getUserId());
            $followers = $followers->merge($newFollowers);
        }

        return $followers;
    }

    /**
     * A tweet url can be split to get access to its status id
     * @param string $url
     * @return string
     */
    private function getStatusIdFromUrl($url)
    {
        $exploded = explode('/', $url);

        return end($exploded);
    }
}
