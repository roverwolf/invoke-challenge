<?php

namespace Wevad\Challenge\LeaderboardBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Wevad\Challenge\LeaderboardBundle\Entity\Player;

class PlayerEvent extends Event
{
    /**
     * @var Player
     */
    private $player;

    /**
     * @param Player $player Player that the event is about
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}