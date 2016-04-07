<?php

namespace AppBundle\Controller;

use AppBundle\Business\Game;
use AppBundle\Business\Metrics;
use AppBundle\Business\RoundLogger;
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

        // Repositories
        $gesture_repository = $this->getDoctrine()->getRepository('AppBundle:Gesture');
        $rule_repository = $this->getDoctrine()->getRepository('AppBundle:Rule');
        $round_log_repository = $this->getDoctrine()->getRepository('AppBundle:RoundLog');

        // Get all Gestures from DataBase
        $gesture_options = $gesture_repository->findAll();

        // init load setting
        $response_array = [
            'gesture_options' => $gesture_options,
            'human_gesture' => null,
            'computer_gesture' => null,
            'result_statement' => 'Ready player one.',
            'metrics' => null,
        ];

        if ($human_gesture_id) {
            $game = (new Game($gesture_repository, $rule_repository))->play($gesture_options, $human_gesture_id);

            $response_array[ 'human_gesture' ] = $game->getHumanGesture();
            $response_array[ 'computer_gesture' ] = $game->getComputerGesture();
            $response_array[ 'result_statement' ] = $game->getResultStatement();

            (new RoundLogger($round_log_repository))->log($game);
        }

        // METRICS
        $om = $this->getDoctrine()->getManager();
        $metrics = (new Metrics($om))->get();
        $response_array[ 'metrics' ] = $metrics;

        return $this->render('default/index.html.twig', $response_array);
    }
}
