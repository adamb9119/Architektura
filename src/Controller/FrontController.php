<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Response;
use App\Entity\Session;
use App\Entity\Question;
use App\Entity\Log;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

/**
 * Description of SurveyController
 *
 * @author Adam
 */
class FrontController extends AppController{
    
    public function getSurvey($id, $slug = '', $page = 1, Request $request){
        
        
        $session = $request->getSession();
        
        $sessionData = $session->get('survey'. $id);
        
        if(!$sessionData){
            $session->set('survey'. $id, [
                'response' => [],
                'page' => $page
            ]);
        }
        
        $em = $this->getDoctrine()->getManager();
        $survey = $em->getRepository(Survey::class)->find($id);
        
        /**
         * Set session ID
         */
        if(!$session->get('session_id')){
            $newSession = new Session();
            $newSession->setSurvey($survey);
            $newSession->setIp($request->getClientIp());
            $em->persist($newSession);
            $em->flush();
            $session->set('session_id', $newSession->getId());
        }
        
        
        
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
        
        
        $questions = $survey->getQuestionsInPagesArray();
        
        return $this->render('survey/form.html.twig', array(
            'survey' => $survey,
            'page' => $page,
            'questions' => $questions[$page - 1]
        ));
        
    }
    
    
    public function save($id, Request $request, LoggerInterface $logger){
        $session = $request->getSession();
        
        $sessionData = $session->get('survey'.$id);
        
        $data = $request->request->all();
        
        $em = $this->getDoctrine()->getManager();
        
        $surveyRepository = $em->getRepository(Survey::class);
        $survey = $surveyRepository->find($id);
        $questions = $survey->getQuestionsInPagesArray();
        
        $logger->debug('Session data', $sessionData);
        $sessionData['response'][$sessionData['page']] = $data['question'];
        $sessionData['page'] = $sessionData['page'] + 1;
        $session->set('survey'.$id, $sessionData);
        
        $logger->debug('Session data', $sessionData);
        
        if($sessionData['page'] <= count($questions)){
            $session->set('survey'.$id, $sessionData);
            return $this->redirectToRoute('app_architektura_survey_pages', [
                'id' => $id,
                'slug' => $survey->getSlug(),
                'page' => $sessionData['page']
            ]);
        }
        
        foreach($sessionData['response'] as $page){
            foreach($page as $q_id => $response){
                $questionRepository = $em->getRepository(Question::class)->find($q_id);
                echo $questionRepository->title;
            }
        }
        
        
        return $this->redirectToRoute('app_architektura_survey_thanks', [
            'id' => $id,
            'slug' => $survey->getSlug(),
        ]);
        
        
    }
    
    public function thanks($id, Request $request){
        $session = $request->getSession();
        
        $em = $this->getDoctrine()->getManager();
        $survey = $em->getRepository(Survey::class)->find($id);
        
        
        $sessionData = $session->get('survey'.$id);
        
        foreach($sessionData['response'] as $page){
            foreach($page as $q_id => $response){
                $questionRepository = $em->getRepository(Question::class)->find($q_id);
                $sessionRepository = $em->getRepository(Session::class)->find($session->get('session_id'));
                $newResponse = new Response();
                $newResponse->setQuestion($questionRepository);
                $newResponse->setSession($sessionRepository);
                $newResponse->setValue($response);
                $em->persist($newResponse);
                $em->flush();
            }
        }
        
        
        return $this->render('survey/thanks.html.twig', array(
            'survey' => $survey,
        ));
    }
    
}
