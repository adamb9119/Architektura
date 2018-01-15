<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;
/**
 * Description of ArrayHelper
 *
 * @author Rafal
 */
class ArrayHelper {
    
    /**
     * Parse array to html attribiutes
     * @param array $attributes
     * @return string
     */
    public static final function arrayToAttribiutes($attributes){
        return join(' ', array_map(function($key) use ($attributes){
            if(is_bool($attributes[$key])){
               return $attributes[$key]?$key:'';
            }
            return $key.'="'.$attributes[$key].'"';
        }, array_keys($attributes)));
    }
    
}
