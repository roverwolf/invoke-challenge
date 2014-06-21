<?php

namespace Wevad\Challenge\LeaderboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="leaderboard")
     * @Template()
     */
    public function leaderboardAction()
    {
        $players = $this->getDoctrine()->getRepository('WevadChallengeLeaderboardBundle:Player')->findAll();

        return array(
            'players' => $players,
        );
    }
}
