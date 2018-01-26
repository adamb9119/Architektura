<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;

/**
 * Description of AlphabetHelper
 *
 * @author Rafal
 */
class AlphabetHelper {
    
    /**
     * Return char from alphabet
     * @param int $number
     * @return string
     */
    public static function getChar($number){
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphabet_array = str_split($alphabet);
        return $alphabet_array[$number];
    }
    
}
