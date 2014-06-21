<?php

namespace Wevad\Challenge\LeaderboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leader
 *
 * @ORM\Table(name="leader")
 * @ORM\Entity(repositoryClass="Wevad\Challenge\LeaderboardBundle\Entity\LeaderRepository")
 */
class Leader
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points = 0;


    /**
     * Create an entry for a leader
     *
     * @param string $name Name of Leader
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add points
     *
     * @param integer $points Number of points to add
     * @return Leader
     */
    public function addPoints($points)
    {
        $this->points += $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }
}
