<?php namespace AppBundle\Business;


use AppBundle\Entity\Gesture;
use AppBundle\Entity\GestureRepository;
use AppBundle\Entity\RuleRepository;

class Game
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
     * @var boolean
     */
    private $human_won = false;


    /**
     * Game constructor.
     * @param GestureRepository $gesture_repository
     * @param RuleRepository $rule_repository
     */
    public function __construct( GestureRepository $gesture_repository, RuleRepository $rule_repository )
    {
        $this->gesture_repository = $gesture_repository;
        $this->rule_repository    = $rule_repository;
    }

    /**
     * @param $gesture_options
     * @param $human_gesture_id
     * @return $this
     */
    public function play( $gesture_options, $human_gesture_id )
    {
        // Default result

        $this->result_statement = "Game ended in a tie";

        $this->human_gesture    = $this->gesture_repository->find( $human_gesture_id );
        $this->computer_gesture = $gesture_options[ array_rand( $gesture_options, 1 ) ];

        $human_wins = $this->rule_repository
            ->findByGestures( $this->human_gesture, $this->computer_gesture );

        // Return if human wins
        if ( $human_wins )
        {
            $this->result_statement = "You won - {$human_wins->getDescription()}";
            $this->human_won = true;
            return $this;
        }

        $computer_wins = $this->rule_repository
            ->findByGestures( $this->computer_gesture, $this->human_gesture );

        if ( $computer_wins )
        {
            $this->result_statement = "Computer won - {$computer_wins->getDescription()}";
        }

        return $this;
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
     * @return boolean
     */
    public function didHumanWin()
    {
        return $this->human_won;
    }

}