<?php

namespace Wevad\Challenge\LeaderboardBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
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
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @DI\InjectParams({
     *     "om" = @DI\Inject("doctrine.orm.entity_manager"),
     *     "dispatcher" = @DI\Inject("event_dispatcher")
     * })
     * @param EntityManagerInterface $om
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EntityManagerInterface $om, EventDispatcherInterface $dispatcher)
    {
        $this->em = $om;
        $this->dispatcher = $dispatcher;
    }

    public function getPlayers()
    {
        $players = $this->em->getRepository('WevadChallengeLeaderboardBundle:Player')->findAll();

        return $players;
    }

    public function getPlayer($playerId)
    {
        $player = $this->em->getRepository('WevadChallengeLeaderboardBundle:Player')->find($playerId);

        return $player;
    }

    public function incrementPlayer(Player $player)
    {
        $this->em->createQuery('
            UPDATE WevadChallengeLeaderboardBundle:Player p
               SET p.points = p.points + 5
             WHERE p.id = :id
        ')
        ->setParameter('id', $player->getId())
        ->execute();

        $this->em->refresh($player);

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