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
     * @ORM\JoinColumn(name="gesture_a_id", referencedColumnName="id")
     */
    private $gesture_a;

    /**
     * @ORM\ManyToOne(targetEntity="Gesture")
     * @ORM\JoinColumn(name="gesture_b_id", referencedColumnName="id")
     */
    private $gesture_b;

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
     * Set gesture_a
     *
     * @param \AppBundle\Entity\Gesture $gestureA
     * @return Rule
     */
    public function setGestureA(\AppBundle\Entity\Gesture $gestureA = null)
    {
        $this->gesture_a = $gestureA;

        return $this;
    }

    /**
     * Get gesture_a
     *
     * @return \AppBundle\Entity\Gesture 
     */
    public function getGestureA()
    {
        return $this->gesture_a;
    }

    /**
     * Set gesture_b
     *
     * @param \AppBundle\Entity\Gesture $gestureB
     * @return Rule
     */
    public function setGestureB(\AppBundle\Entity\Gesture $gestureB = null)
    {
        $this->gesture_b = $gestureB;

        return $this;
    }

    /**
     * Get gesture_b
     *
     * @return \AppBundle\Entity\Gesture 
     */
    public function getGestureB()
    {
        return $this->gesture_b;
    }
}
