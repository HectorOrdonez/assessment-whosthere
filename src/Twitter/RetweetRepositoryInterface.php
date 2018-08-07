<?php

namespace WhosThere\Twitter;

use WhosThere\Twitter\Entity\RetweetCollection;

/**
 * Interface RetweetRepositoryInterface
 *
 * This repository knows how to find retweets
 *
 * @package WhosThere\Twitter
 */
interface RetweetRepositoryInterface
{
    /**
     * @param int $statusId
     * @return RetweetCollection
     */
    public function findAllByStatusId($statusId);
}
