<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Helper\ArrayHelper;

/**
 * Description of MetaExtension
 *
 * @author Rafal
 */
class MetaExtension extends AbstractExtension{
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('metatags', array($this, 'printMeta')),
        );
    }

    public function printMeta($metatags)
    {
        $loader = new FilesystemLoader('../templates/Twig');
        $twig = new Environment($loader, array(
            //'cache' => '../var/cache',
        ));
        
        $return = null;
        foreach ($metatags as $meta){
            $return .= $twig->render('metatags.html.twig', array(
                'type' => isset($meta['type']) ? $meta['type'] : null, 
                'attr' => ArrayHelper::arrayToAttribiutes($meta['attr']),
            ));
        }
        
        return $return;
        
    }
    
}
