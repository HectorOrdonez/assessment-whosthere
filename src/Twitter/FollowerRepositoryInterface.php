<?php

namespace WhosThere\Twitter;

use WhosThere\Twitter\Entity\FollowerCollection;

/**
 * Interface FollowerRepositoryInterface
 *
 * This repository knows how to find followers
 *
 * @package WhosThere\Twitter
 */
interface FollowerRepositoryInterface
{
    /**
     * @param int $userId
     * @return FollowerCollection
     */
    public function findAllByUserId($userId);
}
