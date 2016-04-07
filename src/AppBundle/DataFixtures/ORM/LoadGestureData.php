<?php

use AppBundle\Entity\Gesture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGestureData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rockGesture = new Gesture();
        $rockGesture->setName('rock');
        $manager->persist($rockGesture);

        $this->addReference('rock-gesture', $rockGesture);

        $paperGesture = new Gesture();
        $paperGesture->setName('paper');
        $manager->persist($paperGesture);

        $this->addReference('paper-gesture', $paperGesture);

        $scissorsGesture = new Gesture();
        $scissorsGesture->setName('scissors');
        $manager->persist($scissorsGesture);

        $this->addReference('scissors-gesture', $scissorsGesture);

        $spockGesture = new Gesture();
        $spockGesture->setName('spock');
        $manager->persist($spockGesture);

        $this->addReference('spock-gesture', $spockGesture);

        $lizardGesture = new Gesture();
        $lizardGesture->setName('lizard');
        $manager->persist($lizardGesture);

        $this->addReference('lizard-gesture', $lizardGesture);

        $manager->flush();
    }

    /**
     * Order in which this fixture is applied.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
