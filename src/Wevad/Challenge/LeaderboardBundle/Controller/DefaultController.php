<?php

namespace Wevad\Challenge\LeaderboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="leaderboard")
     * @Template()
     * @Cache(expires="+1 day", smaxage="86400", maxage="86400", public=true)
     */
    public function leaderboardAction()
    {
        return array();
    }
}
