<?php

namespace Wevad\Challenge\LeaderboardBundle\EventListener;

use JMS\DiExtraBundle\Annotation as DI;
use Pubnub\Pubnub;
use Wevad\Challenge\LeaderboardBundle\Event\PlayerEvent;

/**
 * @DI\Service(id="challenge.listener.points")
 */
class PointsListener
{
    private $publishKey;
    private $subscribeKey;

    /**
     * @DI\InjectParams({
     *     "publishKey" = @DI\Inject("%pubnub_publish_key%"),
     *     "subscribeKey" = @DI\Inject("%pubnub_subscribe_key%")
     * })
     * @param $publishKey PubNub publish key
     * @param $subscribeKey PubNub subscribe key
     */
    public function __construct($publishKey, $subscribeKey)
    {
        $this->publishKey = $publishKey;
        $this->subscribeKey = $subscribeKey;
    }

    /**
     * @DI\Observe("player.added_points")
     *
     * @param PlayerEvent $playerEvent
     * @throws \Pubnub\PubnubException
     */
    public function onPointsUpdate(PlayerEvent $playerEvent)
    {
        $pubnub = new Pubnub($this->publishKey, $this->subscribeKey, "", false);

        $info = $pubnub->publish('player_updates', json_encode($playerEvent->getPlayer()));
    }
} 