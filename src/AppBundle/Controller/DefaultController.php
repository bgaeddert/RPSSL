<?php

namespace AppBundle\Controller;

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
        $human_gesture_id = intval( $request->request->get( 'gesture_id' ) );

        // Get all Gestures from DataBase
        $gesture_options = $this->getDoctrine()
            ->getRepository( 'AppBundle:Gesture' )
            ->findAll();

        $human_gesture = $this->getDoctrine()
            ->getRepository( 'AppBundle:Gesture' )
            ->find($human_gesture_id);

        return $this->render('default/index.html.twig',[
            "gesture_options" => $gesture_options,
            "human_gesture" => $human_gesture,
        ]);
    }
}
