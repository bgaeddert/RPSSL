<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        $human_gesture_id = intval( $request->request->get( 'gesture_id' ) );

        // Get all Gestures from DataBase
        $gesture_options = $this->getDoctrine()
            ->getRepository( 'AppBundle:Gesture' )
            ->findAll();

        $response_array = [
            "gesture_options" => $gesture_options,
            "human_gesture" => null,
            "computer_gesture" => null,
        ];

        if($human_gesture_id)
        {
            $human_gesture = $this->getDoctrine()
                ->getRepository( 'AppBundle:Gesture' )
                ->find( $human_gesture_id );

            $response_array["human_gesture"] = $human_gesture;

            $computer_gesture = $gesture_options[ array_rand( $gesture_options, 1 ) ];

            $response_array["computer_gesture"] = $computer_gesture;
        }


        return $this->render('default/index.html.twig',$response_array);
    }
}
