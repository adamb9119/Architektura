<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Answer;
use App\Helper\AlphabetHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    
    
    public function getRaport($id){
        
        $survey = $this->getDoctrine()->getRepository(Survey::class)->find($id);
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'Survey title:');
        $sheet->setCellValue('B1', $survey->title);
        $sheet->setCellValue('A2', 'IP');
        $sheet->setCellValue('B2', 'USER AGENT');
        $sheet->setCellValue('C2', 'ADDED');
        
        
        $questions = $survey->getQuestions();
        
        $rowArray = [];
        $questionArray = [];
        foreach($questions as $question){
            $rowArray[] = $question->title;
            $questionArray[$question->getId()] = [];
        }
        $sheet->fromArray($rowArray,null, 'D2');
        
        $sessions = $survey->getSessions();
        
        $index = 3;
        foreach($sessions as $session){
            $rowArray = [];
            $rowArray[] = $session->getIp();
            $rowArray[] = $session->getClient();
            $rowArray[] = $session->getCreated();
            
            $responses = $session->getResponses();
            foreach ($responses as $response){
                $responseQ = $response->getQuestion();
                
                $value = $response->getValue();
                
                $answer = null;
                if(is_array($value)){
                    $answer = [];
                    foreach ($value as $row){
                        $answerRepo = $this->getDoctrine()->getRepository(Answer::class)->find($row);
                        $answer[] = $answerRepo instanceof Answer ? $answerRepo->title : $value;
                    }
                    $answer = implode(',', $answer);
                    
                }elseif(is_numeric($value)){
                    $answerRepo = $this->getDoctrine()->getRepository(Answer::class)->find($value);
                    $answer = $answerRepo instanceof Answer ? $answerRepo->title : $value;
                
                }else{
                    $answer = $value;
                }
                $questionArray[$responseQ->getId()][] = $answer;
            }
            
            $sheet->fromArray($rowArray, null, 'A' . $index);
            $index++;
        }
        
        
        
        $qArrayIndex = 3;
        foreach ($questionArray as $qArray){
            $sheet->fromArray(array_chunk($qArray,1),null, AlphabetHelper::getChar($qArrayIndex) . '3');
            $qArrayIndex++;
        }
        
        $file = $survey->getSlug() .'-'. date('Ymdihs') . '.xlsx';
        
        $writer = new Xlsx($spreadsheet);
        $writer->save($file);
        
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $file);
        return $response;
    }
    
}
