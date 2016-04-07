<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoundLog.
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RoundLogRepository")
 */
class RoundLog
{
    /**
     * @ORM\ManyToOne(targetEntity="Gesture")
     * @ORM\JoinColumn(name="human_gesture_id", referencedColumnName="id")
     */
    private $human_gesture;

    /**
     * @ORM\ManyToOne(targetEntity="Gesture")
     * @ORM\JoinColumn(name="comp_gesture_id", referencedColumnName="id")
     */
    private $comp_gesture;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="human_won", type="boolean")
     */
    private $humanWon;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set humanWon.
     *
     * @param bool $humanWon
     *
     * @return RoundLog
     */
    public function setHumanWon($humanWon)
    {
        $this->humanWon = $humanWon;

        return $this;
    }

    /**
     * Get humanWon.
     *
     * @return bool
     */
    public function getHumanWon()
    {
        return $this->humanWon;
    }

    /**
     * Set human_gesture.
     *
     * @param \AppBundle\Entity\Gesture $humanGesture
     *
     * @return RoundLog
     */
    public function setHumanGesture(\AppBundle\Entity\Gesture $humanGesture = null)
    {
        $this->human_gesture = $humanGesture;

        return $this;
    }

    /**
     * Get human_gesture.
     *
     * @return \AppBundle\Entity\Gesture
     */
    public function getHumanGesture()
    {
        return $this->human_gesture;
    }

    /**
     * Set comp_gesture.
     *
     * @param \AppBundle\Entity\Gesture $compGesture
     *
     * @return RoundLog
     */
    public function setCompGesture(\AppBundle\Entity\Gesture $compGesture = null)
    {
        $this->comp_gesture = $compGesture;

        return $this;
    }

    /**
     * Get comp_gesture.
     *
     * @return \AppBundle\Entity\Gesture
     */
    public function getCompGesture()
    {
        return $this->comp_gesture;
    }
}
