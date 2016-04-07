<?php

use AppBundle\Entity\Gesture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGestureData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rockGesture = new Gesture();
        $rockGesture->setName('rock');
        $manager->persist($rockGesture);

        $paperGesture = new Gesture();
        $paperGesture->setName('paper');
        $manager->persist($paperGesture);

        $scissorsGesture = new Gesture();
        $scissorsGesture->setName('scissors');
        $manager->persist($scissorsGesture);

        $lizardGesture = new Gesture();
        $lizardGesture->setName('lizard');
        $manager->persist($lizardGesture);

        $spockGesture = new Gesture();
        $spockGesture->setName('spock');
        $manager->persist($spockGesture);

        $manager->flush();
    }
}