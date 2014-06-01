<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$paratus['navbar'] = array( 
  'class' => 'navbar', 
  'items' => array( 
      'me'  => array('text'  =>'Jag', 'url' => 'me.php', 'title' => 'title'), 
      'report'  => array('text'  =>'Redovisningar', 'url' => 'report.php', 'title' => 'title'), 
      'dicegame'  => array('text'  =>'Tärningsspelet','url' => 'dicegame.php', 'title' => 'title'), 
      'movie_view'  => array('text'  =>'Filmer', 'url'   =>'movie_view.php', 'title' => 'Some title 2', 
        'submenu' => array( 
         'items' => array( 
           // This is a menu item of the submenu 
          'movie_login'  => array('text'  => 'Logga in', 'url' => 'movie_login.php', 'title' => 'title'), 
           // This is a menu item of the submenu 
          'movie_logout'  => array('text'  => 'Logga ut', 'url' => 'movie_logout.php', 'title' => 'title'), 
          // This is a menu item of the submenu 
          'movie_view_edit'  => array('text'  => 'Uppdatera film', 'url' => 'movie_view_edit.php', 'title' => 'title'), 
          // This is a menu item of the submenu 
          'movie_create'  => array('text'  => 'Skapa ny film', 'url' => 'movie_create.php', 'title' => 'title'), 
           // This is a menu item of the submenu 
          'movie_view_delete'  => array('text'  => 'Ta bort film', 'url' => 'movie_view_delete.php', 'title' => 'title'), 
      ), 
      ), 
    ), 
    'content_view'  => array('text'  =>'Visa content-databasen', 'url' => 'content_view.php', 'title' => 'title', 
      'submenu' => array( 
         'items' => array( 
           // This is a menu item of the submenu 
          'blog'  => array('text'  => 'Visa alla blogposter', 'url' => 'blog.php', 'title' => 'title'), 
          'movie_login'  => array('text'  => 'Logga in', 'url' => 'movie_login.php', 'title' => 'title'), 
           // This is a menu item of the submenu 
          'movie_logout'  => array('text'  => 'Logga ut', 'url' => 'movie_logout.php', 'title' => 'title'), 
          ), 
         ), 
      ), 
    'source'  => array('text'  =>'Källkod', 'url' => 'source.php', 'title' => 'title'), 
  ), 
  // This is the callback tracing the current selected menu item base on scriptname 
  'callback' => function($url)  
  { 
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {return true;} 
  } 
);  
