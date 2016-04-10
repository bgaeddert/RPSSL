<?php

use AppBundle\Entity\Rule;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRuleData extends AbstractFixture implements FixtureInterface
{
    /**
     * All the winning combinations of gestures
     * and their victory description.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // References from LoadRulesData Fixture
        $rockGesture = $this->getReference('rock-gesture');
        $paperGesture = $this->getReference('paper-gesture');
        $scissorsGesture = $this->getReference('scissors-gesture');
        $lizardGesture = $this->getReference('lizard-gesture');
        $spockGesture = $this->getReference('spock-gesture');

        // Rock Crushes Scissors
        $rule = new Rule();
        $rule->setGestureA($rockGesture);
        $rule->setGestureB($scissorsGesture);
        $rule->setDescription('Rock Crushes Scissors');
        $manager->persist($rule);

        // Rock Crushes Lizard
        $rule = new Rule();
        $rule->setGestureA($rockGesture);
        $rule->setGestureB($lizardGesture);
        $rule->setDescription('Rock Crushes Lizard');
        $manager->persist($rule);

        // Paper covers Rock
        $rule = new Rule();
        $rule->setGestureA($paperGesture);
        $rule->setGestureB($rockGesture);
        $rule->setDescription('Paper covers Rock');
        $manager->persist($rule);

        // Paper disproves spock
        $rule = new Rule();
        $rule->setGestureA($paperGesture);
        $rule->setGestureB($spockGesture);
        $rule->setDescription('Paper disproves spock');
        $manager->persist($rule);

        // Scissors cut paper
        $rule = new Rule();
        $rule->setGestureA($scissorsGesture);
        $rule->setGestureB($paperGesture);
        $rule->setDescription('Scissors cut paper');
        $manager->persist($rule);

        // Scissors decapitate Lizard
        $rule = new Rule();
        $rule->setGestureA($scissorsGesture);
        $rule->setGestureB($lizardGesture);
        $rule->setDescription('Scissors decapitate Lizard');
        $manager->persist($rule);

        // Lizard eats Paper
        $rule = new Rule();
        $rule->setGestureA($lizardGesture);
        $rule->setGestureB($paperGesture);
        $rule->setDescription('Lizard eats Paper');
        $manager->persist($rule);

        // Lizard poisons Spock
        $rule = new Rule();
        $rule->setGestureA($lizardGesture);
        $rule->setGestureB($spockGesture);
        $rule->setDescription('Lizard poisons Spock');
        $manager->persist($rule);

        // Spock vaporizes Rock
        $rule = new Rule();
        $rule->setGestureA($spockGesture);
        $rule->setGestureB($rockGesture);
        $rule->setDescription('Spock vaporizes Rock');
        $manager->persist($rule);

        // Spock smashes Scissors
        $rule = new Rule();
        $rule->setGestureA($spockGesture);
        $rule->setGestureB($scissorsGesture);
        $rule->setDescription('Spock smashes Scissors');
        $manager->persist($rule);

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
