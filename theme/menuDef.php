<?php

/**
 * Define the menu as an array
 */
$menu = array(
  // Use for styling the menu
  'class' => 'navbar',
 
  // Here comes the menu strcture
  'items' => array(
    // This is a menu item
    'home'  => array(
      'text'  =>'Home',   
      'url'   =>'index.php',  
      'title' => 'Some title 1'
    ),
 
    // This is a menu item
    'test'  => array(
      'text'  =>'Test with submenu',   
      'url'   =>'test.php',   
      'title' => 'Some title 2',
 
      // Here we add the submenu, with some menu items, as part of a existing menu item
      'submenu' => array(
 
        'items' => array(
          // This is a menu item of the submenu
          'item 1'  => array(
            'text'  => 'Item 1',   
            'url'   => 'item1.php',  
            'title' => 'Some item 1'
          ),
 
          // This is a menu item of the submenu
          'item 2'  => array(
            'text'  => 'Item 2',   
            'url'   => 'item2.php',  
            'title' => 'Some item 2'
          ),
        ),
      ),
    ),
 
    // This is a menu item
    'about' => array(
      'text'  =>'About', 
      'url'   =>'about.php',  
      'title' => 'Some title 3'
    ),
  ),
 
  // This is the callback tracing the current selected menu item base on scriptname
  'callback' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);