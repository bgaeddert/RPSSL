<?php

namespace AppBundle\Controller;

use AppBundle\Service\GameService;
use AppBundle\Service\MetricsService;
use AppBundle\Service\RoundLogService;
use AppBundle\Entity\RoundLog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction( Request $request )
    {
        // Get all Gestures from DataBase
        $gesture_options = $this->get( 'gesture_service' )->getOptions();

        // init load setting
        $response_array = [
            'gesture_options'  => $gesture_options,
            'human_gesture'    => null,
            'computer_gesture' => null,
            'result_statement' => 'Ready player one.',
            'metrics'          => null,
        ];

        // METRICS
        $response_array[ 'metrics' ] = $this->get( 'metrics_service' )->get();

        return $this->render( 'default/index.html.twig', $response_array );
    }

    /**
     * @Route("/", name="play")
     * @Method("POST")
     */
    public function playAction( Request $request )
    {
        // INPUT
        $human_gesture_id = intval( $request->request->get( 'gesture_id' ) );

        $human_gesture = $this->get( "gesture_repository" )->find( $human_gesture_id );

        if ( $human_gesture == null )
        {
            $this->addFlash('error','Gesture not found!');
            return $this->redirectToRoute( 'homepage' );
        }

        // Get all Gestures from DataBase
        $gesture_options = $this->get( 'gesture_service' )->getOptions();
        $response_array[ 'gesture_options' ]  = $gesture_options;

        $game = $this->get( 'game_service' )->play( $gesture_options, $human_gesture_id );
        $this->get( 'round_logger_service' )->log( $game );

        $response_array[ 'human_gesture' ]    = $game->getHumanGesture();
        $response_array[ 'computer_gesture' ] = $game->getComputerGesture();
        $response_array[ 'result_statement' ] = $game->getResultStatement();

        // METRICS
        $response_array[ 'metrics' ] = $this->get( 'metrics_service' )->get();

        return $this->render( 'default/index.html.twig', $response_array );
    }
}
