<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of AdminController
 *
 * @author Rafal
 */
class AdminController extends AppController{
   
    
    public function dashboardAction()
    {
       
        return $this->render('dashboard.html.twig', array(
            'number' => 'asdsa',
            'meta' => [
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
            ]
        ));
    }
}
