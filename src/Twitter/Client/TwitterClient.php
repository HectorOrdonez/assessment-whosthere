<?php

namespace WhosThere\Twitter\Client;

use Abraham\TwitterOAuth\TwitterOAuth;
use WhosThere\Twitter\Exception\TwitterClientException;
use WhosThere\Twitter\TwitterClientInterface;

/**
 * Class TwitterClient
 *
 * This is the twitter client. It knows how to talk to the twitter api
 *
 * @package WhosThere\Twitter\Client
 */
class TwitterClient extends TwitterOAuth implements TwitterClientInterface
{
    /**
     * @inheritdoc
     * @throws TwitterClientException
     */
    public function getFollowersList($userId)
    {
        $response = $this->get('followers/list', [
            'user_id' => $userId,
            'skip_status' => true,
        ]);

        if ($this->hasErrors($response)) {
            $this->throwException($response);
        }

        return array_map(function ($user) {
            return ['id' => $user->id];
        }, $response->users);
    }

    /**
     * @inheritdoc
     */
    public function getRetweetersList($statusId)
    {
        $response = $this->get('statuses/retweeters/ids', [
            'id' => $statusId,
        ]);

        if ($this->hasErrors($response)) {
            $this->throwException($response);
        }

        return $response->ids;
    }

    /**
     * @param $response
     * @return bool
     */
    private function hasErrors($response)
    {
        return isset($response->errors);
    }

    /**
     * @param $response
     * @throws TwitterClientException
     */
    private function throwException($response)
    {
        throw new TwitterClientException($response->errors);
    }
}
