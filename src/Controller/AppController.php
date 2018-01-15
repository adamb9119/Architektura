<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;
/**
 * Description of LuckyController
 *
 * @author Rafal
 */
class AppController extends Controller
{
    
    public function __construct() {
        
    }
    
    public function indexAction()
    {
        $number = mt_rand(0, 100);
        
        $configDirectories = array('../config/');

        $yamlUserFiles = Yaml::parseFile('../config/users.yml');
        
        
        return $this->render('index.html.twig', array(
            'number' => $number,
            'meta' => [
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
                ['attr' => ['property' => 'asdasdsad']],
            ]
        ));
    }
    
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('app_architektura_login');
        }

        return $this->render(
            'page/register.html.twig',
            array('form' => $form->createView())
        );
    }
    
}
