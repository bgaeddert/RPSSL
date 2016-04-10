<?php

namespace AppBundle\Service;

use AppBundle\Entity\Gesture;
use AppBundle\Entity\GestureRepository;
use AppBundle\Entity\RuleRepository;

class RoundService
{
    /**
     * @var GestureRepository
     */
    private $gesture_repository;

    /**
     * @var RuleRepository
     */
    private $rule_repository;

    /**
     * @var Gesture
     */
    private $human_gesture;

    /**
     * @var Gesture
     */
    private $computer_gesture;

    /**
     * @var string
     */
    private $result_statement;

    /**
     * @var bool
     */
    private $human_won = false;

    /**
     * Game constructor.
     *
     * @param GestureRepository $gesture_repository
     * @param RuleRepository $rule_repository
     */
    public function __construct(GestureRepository $gesture_repository, RuleRepository $rule_repository)
    {
        $this->gesture_repository = $gesture_repository;
        $this->rule_repository    = $rule_repository;
    }

    /**
     * Determines winner Human or Computer
     *
     * @param Gesture $human_gesture
     * @param Gesture $computer_gesture
     * @return $this
     */
    public function play(Gesture $human_gesture, Gesture $computer_gesture)
    {
        // Set gestures
        $this->human_gesture    = $human_gesture;
        $this->computer_gesture = $computer_gesture;

        if ($this->humanWins()) {
            return $this;
        }

        if ($this->computerWins()) {
            return $this;
        }

        // Default result ( no winner found )
        $this->result_statement = 'Game ended in a tie';
        $this->human_won        = false;

        return $this;
    }

    /**
     * Since only winning gestures exist in the database
     * the human wins if a row is found with this provided
     * combination of [ human gesture, computer gesture ]
     *
     * @return bool
     */
    private function humanWins()
    {
        $winning_rule_found = $this->rule_repository
            ->findByGestures($this->human_gesture, $this->computer_gesture);

        if ($winning_rule_found) {
            $this->result_statement = "You won - {$winning_rule_found->getDescription()}";
            $this->human_won        = true;

            return true;
        }

        return false;
    }

    /**
     * Since only winning gestures exist in the database
     * the computer wins if a row is found with the inversion
     * of the provided combination to [ computer gesture, human gesture ]
     *
     * @return bool
     */
    private function computerWins()
    {
        $winning_rule_found = $this->rule_repository
            ->findByGestures($this->computer_gesture, $this->human_gesture);

        if ($winning_rule_found) {
            $this->result_statement = "Computer won - {$winning_rule_found->getDescription()}";
            $this->human_won        = false;

            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getHumanGesture()
    {
        return $this->human_gesture;
    }

    /**
     * @return mixed
     */
    public function getComputerGesture()
    {
        return $this->computer_gesture;
    }

    /**
     * @return mixed
     */
    public function getResultStatement()
    {
        return $this->result_statement;
    }

    /**
     * @return bool
     */
    public function didHumanWin()
    {
        return $this->human_won;
    }
}
