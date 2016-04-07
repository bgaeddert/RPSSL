<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 4/7/2016
 * Time: 10:04 AM
 */

namespace AppBundle\Service;

use AppBundle\Entity\GestureRepository;

class GestureService
{
    /**
     * @var GestureRepository
     */
    private $gesture_repository;

    /**
     * GestureService constructor.
     * @param GestureRepository $gesture_repository
     */
    public function __construct(GestureRepository $gesture_repository)
    {
        $this->gesture_repository = $gesture_repository;
    }

    public function getOptions()
    {
        return $this->gesture_repository->findAll();
    }
}
