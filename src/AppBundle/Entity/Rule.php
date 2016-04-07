<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoundLog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RuleRepository")
 */
class Rule
{
    /**
     * @ORM\ManyToOne(targetEntity="Gesture")
     * @ORM\JoinColumn(name="p1_gesture_id", referencedColumnName="id")
     */
    private $p1_gesture;

    /**
     * @ORM\ManyToOne(targetEntity="Gesture")
     * @ORM\JoinColumn(name="p2_gesture_id", referencedColumnName="id")
     */
    private $p2_gesture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

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
     * Set description
     *
     * @param string $description
     * @return Rule
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set p1_gesture
     *
     * @param \AppBundle\Entity\Gesture $p1Gesture
     * @return Rule
     */
    public function setP1Gesture(\AppBundle\Entity\Gesture $p1Gesture = null)
    {
        $this->p1_gesture = $p1Gesture;

        return $this;
    }

    /**
     * Get p1_gesture
     *
     * @return \AppBundle\Entity\Gesture 
     */
    public function getP1Gesture()
    {
        return $this->p1_gesture;
    }

    /**
     * Set p2_gesture
     *
     * @param \AppBundle\Entity\Gesture $p2Gesture
     * @return Rule
     */
    public function setP2Gesture(\AppBundle\Entity\Gesture $p2Gesture = null)
    {
        $this->p2_gesture = $p2Gesture;

        return $this;
    }

    /**
     * Get p2_gesture
     *
     * @return \AppBundle\Entity\Gesture 
     */
    public function getP2Gesture()
    {
        return $this->p2_gesture;
    }
}
