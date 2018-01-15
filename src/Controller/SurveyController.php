<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\SurveyType;
use App\Entity\Survey;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SurveyController
 *
 * @author Adam
 */
class SurveyController extends Controller{
    
    public function add(Request $request, \Swift_Mailer $mailer){
        
        
        // 1) build the form
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($survey);
            $em->flush();

        }

        return $this->render(
            'survey/add.html.twig',
            array('form' => $form->createView())
        );
    }
    
}
