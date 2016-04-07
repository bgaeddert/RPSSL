<?php

namespace AppBundle\Service;

use AppBundle\Entity\RoundLog;
use AppBundle\Entity\RoundLogRepository;

class RoundLogService
{
    /**
     * @var RoundLogRepository
     */
    private $round_log_repository;

    /**
     * RoundLogger constructor.
     *
     * @param RoundLogRepository $round_log_repository
     */
    public function __construct(RoundLogRepository $round_log_repository)
    {
        $this->round_log_repository = $round_log_repository;
    }

    public function log( RoundService $game)
    {
        $round_log = new RoundLog();
        $round_log->setHumanGesture($game->getHumanGesture());
        $round_log->setCompGesture($game->getComputerGesture());
        $round_log->setHumanWon($game->didHumanWin());

        $this->round_log_repository->save($round_log);
    }
}
