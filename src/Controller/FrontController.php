<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of SurveyController
 *
 * @author Adam
 */
class FrontController extends AppController{
    
    public function getSurvey($id, $slug = '', $page = 0){
        
        $em = $this->getDoctrine()->getManager();
        
        $survey = $em->getRepository(Survey::class)->find($id);
        
        
        
        if(!$survey || $survey->status != 1){
            throw $this->createNotFoundException('The survey does not exist');
        }
        
        /**
         * Log view counter
         */
        $log = new Log();
        $log->title = 'view';
        $log->setSurvey($survey);
        $em->persist($log);
        $em->flush();
        
        return $this->render('survey/form.html.twig', array(
            'survey' => $survey,
            'page' => $page
        ));
        
    }
    
}
