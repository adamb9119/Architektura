<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Survey;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of SurveyController
 *
 * @author Adam
 */
class SummaryController extends AppController{
    
    public function summary($id){
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        
        return $this->render(
            'survey/summary.html.twig',
           [
               'survey' => $survey
           ]
        );
    }
    
    public function getViews($id, Request $request){
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        
        $logs = $survey->getLogs();
        $data = [];
        foreach($logs as $log){
            $data[] = [
                'title' => $log->title,
                'date' => $log->added
            ];
        }
        
        return new JsonResponse([
            'code' => '200',
            'views' => $data
        ]);
    }
    
    
}
