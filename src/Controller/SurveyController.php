<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Form\SurveyType;
use App\Form\EditSurveyType;
use App\Form\QuestionNewType;
use App\Entity\Survey;
use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;


/**
 * Description of SurveyController
 *
 * @author Adam
 */
class SurveyController extends AppController{
    
    public function surveyList(){
        
        $user = $this->getUser();
        $surveys = $user->getSurveys();
        
        return $this->render(
            'survey/list.html.twig',
            [
                'surveys' => $surveys
            ]
        );
    }
    
    public function add(Request $request){
        
        // 1) build the form
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $survey->setUser($user);
            $em->persist($survey);
            $em->flush();
            
            return $this->redirectToRoute('app_architektura_admin_survey_edit', array('id' => $survey->getId()));
            
        }

        return $this->render(
            'survey/add.html.twig',
            array('form' => $form->createView())
        );
    }
    
    public function edit($id, Request $request){
        
        $session = new Session();
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        
        $form = $this->createForm(EditSurveyType::class, $survey);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($survey);
            $em->flush();

            $session->getFlashBag()->add('notice', 'Survey updated!');
        }

        return $this->render(
            'survey/edit.html.twig',
           [
               'form' => $form->createView(),
               'survey' => $survey
           ]
        );
    }
    
    public function remove($id){
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($survey);
        $em->flush();
        
        return $this->redirectToRoute('app_architektura_admin_survey_list');
  
    }
    
    public function questions($id){
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        
        return $this->render(
            'survey/questions.html.twig',
           [
               'survey' => $survey
           ]
        );
    } 
    
    public function ajaxGetQuestionNewForm(){
        
        $form = $this->createForm(QuestionNewType::class);
        
        return $this->render(
            'survey/questionNewForm.html.twig',
           [
               'form' => $form->createView()
           ]
        );
        
    }
    
    public function ajaxAddQuestion($id, Request $request, LoggerInterface $logger){
        $request->request->replace(json_decode($request->getContent(), true));
        
        $logger->debug('AjaxAddQuestion', $request->request->all());
        return new JsonResponse([
            'code' => '200',
            'data' => 'Question added!' .  $request->request->get('title'),
            'response' => $request->request->all()
        ]);
            
        
    }
    
}
