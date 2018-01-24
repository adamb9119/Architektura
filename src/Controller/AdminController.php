<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Usermeta;
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

        $product = new Usermeta();
        $product->setName('Keyboard');

        // relate this product to the category
        $product->setUser($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        
//         $category = new Category();
//        $category->setName('Computer Peripherals');
//
//        $product = new Product();
//        $product->setName('Keyboard');
//
//        // relate this product to the category
//        $product->setCategory($category);
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($category);
//        $em->persist($product);
//        $em->flush();
//
//        return new Response(
//            'Saved new product with id: '.$product->getId()
//            .' and new category with id: '.$category->getId()
//        );
        
//        $product = $this->getDoctrine()
//        ->getRepository(Product::class)
//        ->find(1);
//
//        
//        $category = $product->getCategory();
//        echo $category;
        
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
