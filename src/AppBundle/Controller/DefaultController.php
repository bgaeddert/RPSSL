<?php

namespace AppBundle\Controller;

use AppBundle\Service\RoundService;
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction( Request $request )
    {
        // Get all Gestures from DataBase
        $gesture_options = $this->get( 'gesture_service' )->getOptions();

        // Build response array
        $response_array[ 'gesture_options' ]  = $gesture_options;
        $response_array[ 'human_gesture' ]    = null;
        $response_array[ 'computer_gesture' ] = null;
        $response_array[ 'result_statement' ] = 'Ready player one.';
        $response_array[ 'metrics' ]          = $this->get( 'metrics_service' )->get();

        return $this->render( 'default/index.html.twig', $response_array );
    }

    /**
     * @Route("/", name="play")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function playAction( Request $request )
    {
        // Resolve input
        $human_gesture_id = intval( $request->request->get( 'gesture_id' ) );
        $human_gesture    = $this->get( "gesture_repository" )->find( $human_gesture_id );

        // Validate
        if ( $human_gesture == null )
        {
            $this->addFlash( 'error', 'Gesture not found!' );
            return $this->redirectToRoute( 'homepage' );
        }

        // Get all Gestures from DataBase
        $gesture_options = $this->get( 'gesture_service' )->getOptions();

        // Run game logic
        $round = $this->get( 'round_service' )->play( $gesture_options, $human_gesture );

        // Log results
        $this->get( 'round_logger_service' )->log( $round );

        // Build response array
        $response_array[ 'gesture_options' ]  = $gesture_options;
        $response_array[ 'human_gesture' ]    = $round->getHumanGesture();
        $response_array[ 'computer_gesture' ] = $round->getComputerGesture();
        $response_array[ 'result_statement' ] = $round->getResultStatement();
        $response_array[ 'metrics' ]          = $this->get( 'metrics_service' )->get();

        return $this->render( 'default/index.html.twig', $response_array );
    }
}
