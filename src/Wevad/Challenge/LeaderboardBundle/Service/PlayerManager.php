<?php

namespace Wevad\Challenge\LeaderboardBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Wevad\Challenge\LeaderboardBundle\Entity\Player;
use Wevad\Challenge\LeaderboardBundle\Event\PlayerEvent;

/**
 * @DI\Service(id="challenge.manager.player")
 */
class PlayerManager
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @DI\InjectParams({
     *     "om" = @DI\Inject("doctrine.orm.entity_manager"),
     *     "dispatcher" = @DI\Inject("event_dispatcher")
     * })
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, EventDispatcherInterface $dispatcher)
    {
        $this->om = $om;
        $this->dispatcher = $dispatcher;
    }

    public function getPlayers()
    {
        $players = $this->om->getRepository('WevadChallengeLeaderboardBundle:Player')->findAll();

        return $players;
    }

    public function getPlayer($playerId)
    {
        $player = $this->om->getRepository('WevadChallengeLeaderboardBundle:Player')->find($playerId);

        return $player;
    }

    public function incrementPlayer(Player $player)
    {
        $player->addPoints(5);
        $this->om->flush();

        $this->dispatcher->dispatch('player.added_points', new PlayerEvent($player));

        return $player;
    }

    public function incrementPlayerById($playerId)
    {
        $player = $this->getPlayer($playerId);

        $this->incrementPlayer($player);

        return $player;
    }
}