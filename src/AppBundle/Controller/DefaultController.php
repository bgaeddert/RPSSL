<?php

namespace AppBundle\Controller;

use AppBundle\Service\GameService;
use AppBundle\Service\MetricsService;
use AppBundle\Service\RoundLogService;
use AppBundle\Entity\RoundLog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // INPUT
        $human_gesture_id = intval($request->request->get('gesture_id'));

        // Get all Gestures from DataBase
        $gesture_options = $this->get('gesture_service')->getOptions();

        // init load setting
        $response_array = [
            'gesture_options' => $gesture_options,
            'human_gesture' => null,
            'computer_gesture' => null,
            'result_statement' => 'Ready player one.',
            'metrics' => null,
        ];

        if ($human_gesture_id) {
            $game = $this->get('game_service')->play($gesture_options, $human_gesture_id);

            $response_array[ 'human_gesture' ] = $game->getHumanGesture();
            $response_array[ 'computer_gesture' ] = $game->getComputerGesture();
            $response_array[ 'result_statement' ] = $game->getResultStatement();

            $this->get('round_logger_service')->log($game);
        }

        // METRICS
        $response_array[ 'metrics' ] = $this->get('metrics_service')->get();

        return $this->render('default/index.html.twig', $response_array);
    }
}
