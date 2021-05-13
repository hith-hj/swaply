<?php 
if (! function_exists('markWords')) 
{
    function markWords($string, $term){
        $term = preg_replace('/\s+/', ' ', trim($term));
        $words = explode(' ', $term);
    
        $highlighted = array();
        foreach ( $words as $word ){
            // $highlighted[] = strtoupper($word);
            $highlighted[] = '"'.$word.'"';
        }    
        return str_replace($words, $highlighted, $string);
    }
}