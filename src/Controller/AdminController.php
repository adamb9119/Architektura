<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Description of AdminController
 *
 * @author Rafal
 */
class AdminController extends AppController{
   
    
    public function dashboardAction()
    {
        $user = $this->getUser();
        return $this->render('dashboard.html.twig', array(
            'number' => 'asdsa',
            'meta' => [
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
            ]
        ));
    }
    
    public function profile(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
        }

        return $this->render(
            'page/register.html.twig',
            array('form' => $form->createView())
        );
    }
    
    public function userMenuBar(){
        $user = $this->getUser();
        if($user){
            return $this->render(
                'other/menu.user.bar.html.twig',[
                    'name' => $user->getEmail()
                ]
            );
        }
        return $this->render('other/menu.user.bar.html.twig');
        
    }
}
