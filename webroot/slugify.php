<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Create a slug of a string, to be used as url.
 *
 * @param string $str the string to format as slug.
 * @returns str the formatted slug. 
 */
function slugify($str) {
  $str = mb_strtolower(trim($str));
  $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
  $str = preg_replace('/[^a-z0-9-]/', '-', $str);
  $str = trim(preg_replace('/-+/', '-', $str), '-');
  return $str;
}