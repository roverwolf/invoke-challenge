<?php

namespace Wevad\Challenge\LeaderboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ApiController extends Controller
{
    /**
     * @Route("/api/players.{_format}", defaults={"_format"="json"}, name="players_get")
     * @Template()
     * @Method("GET")
     */
    public function getAllPlayersAction()
    {
        $playerService = $this->get('challenge.manager.player');

        $players = $playerService->getPlayers();

        return array(
            'players' => $players,
        );
    }

    /**
     * @Route("/api/players/{id}.{_format}", defaults={"_format"="json"}, name="players_get_one")
     * @Template()
     * @Method("GET")
     */
    public function getPlayerAction($id)
    {
        $playerService = $this->get('challenge.manager.player');
        $player = $playerService->getPlayer($id);

        return array(
            'player' => $player,
        );
    }

    /**
     * @Route("/api/players/{id}.{_format}", defaults={"_format"="json"}, name="players_increment")
     * @Template()
     * @Method("PUT")
     */
    public function incrementPlayerAction($id)
    {
        $playerService = $this->get('challenge.manager.player');
        $player = $playerService->incrementPlayerById($id);

        return array(
            'player' => $player,
        );
    }
}
