<?php

namespace AppBundle\Business;

use Doctrine\Common\Persistence\ObjectManager;

class Metrics
{
    private $om;

    /**
     * Metrics constructor.
     *
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function get()
    {
        $raw = $this->om->getConnection()->prepare("
                  SELECT
                      count(*)        total,
                      sum(CASE WHEN human_won = '1' THEN 1 ELSE 0 END) human_win_count,
                      sum(CASE WHEN human_won = '0' THEN 1 ELSE 0 END) comp_win_count,

                      sum(CASE WHEN human_gesture_id = '1' THEN 1 ELSE 0 END) human_rock_count,
                      sum(CASE WHEN human_gesture_id = '2' THEN 1 ELSE 0 END) human_paper_count,
                      sum(CASE WHEN human_gesture_id = '3' THEN 1 ELSE 0 END) human_scissors_count,
                      sum(CASE WHEN human_gesture_id = '4' THEN 1 ELSE 0 END) human_spock_count,
                      sum(CASE WHEN human_gesture_id = '5' THEN 1 ELSE 0 END) human_lizard_count,

                      sum(CASE WHEN comp_gesture_id = '1' THEN 1 ELSE 0 END) comp_rock_count,
                      sum(CASE WHEN comp_gesture_id = '2' THEN 1 ELSE 0 END) comp_paper_count,
                      sum(CASE WHEN comp_gesture_id = '3' THEN 1 ELSE 0 END) comp_scissors_count,
                      sum(CASE WHEN comp_gesture_id = '4' THEN 1 ELSE 0 END) comp_spock_count,
                      sum(CASE WHEN comp_gesture_id = '5' THEN 1 ELSE 0 END) comp_lizard_count
                FROM round_log;
        ");

        $raw->execute();

        $metrics = $raw->fetchAll();

        if (count($metrics)) {
            return $metrics[0];
        }

        return false;
    }
}
