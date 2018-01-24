<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Survey;
use App\Entity\User;

/**
 * Description of SuperAdminController
 *
 * @author Adam
 */
class SuperAdminController extends AppController{
    
    public function surveyList(){
        
        $surveys = $this->getDoctrine()->getRepository(Survey::class)->findAll();
        
        return $this->render(
            'survey/list.html.twig',
            [
                'surveys' => $surveys
            ]
        );
    }
    
    public function usersList(){
        
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        
        return $this->render(
            'superadmin/users.html.twig',
            [
                'users' => $users
            ]
        );
    }
    
    public function userRemove($id){
        
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        
        return $this->redirectToRoute('app_architektura_superadmin_users_list');
    }
    
    public function userToggleActive($id){
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository(User::class)->find($id);
        $user->isActive = !$user->isActive;
        
        $em->flush();
        
        return $this->redirectToRoute('app_architektura_superadmin_users_list');
    }
    
    
}
