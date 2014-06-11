<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bwix['navbar'] = array(
    
      // Use for styling the menu
  'class' => 'navbar',
 //    'class' => 'nb-plain',
 
  // Here comes the menu strcture
  'items' => array(
    // This is a menu item

      
          'hem'          => array(
          'text'=>'Hem',          
          'url'=>'me.php',         
          'title' => 'Min presentation om mig själv'
              ),
      
     'redovisning'  => array(
      'text'=>'Redovisning', 
     'url'=>'redovisning.php', 
     'title' => 'Redovisningar för kursmomenten'
    ),
      
        
              'tarningsspel' => array(
              'text'=>'Tärningsspel', 
              'url'=>'tarning.php',     
              'title' => 'SpelaTärning'
              ),   
          
          // This is a menu item

        
              'pflimmer'     => array(
               'text'=>'Pflimmer',    
              'url'=>'pflimmer.php',   
              'title' => 'KollaFilm',    
 
      // Here we add the submenu, with some menu items, as part of a existing menu item
      'submenu' => array(
          
                  'items' => array(
            
              'hem'       => array(
                  'text'=>'Alla filmer',   
                  'url'=>'movie_connect.php',        
                  'title' => 'Alla filmer'
                  ),
    'reset'     => array(
        'text'=>'Återställ',    
        'url'=>'movie_reset.php',          
        'title' => 'Återställ'
        ),

                          'sort'      => array('text'=>'Sortera',       'url'=>'movie_sort.php',           'title' => 'Sortera per kolumn'),
    'login'     => array('text'=>'Login',         'url'=>'movie_login.php',          'title' => 'Logga in för att ändra i databasen'),
    'logout'    => array('text'=>'Logout',        'url'=>'movie_logout.php',         'title' => 'Logga ut'),
    'edit'      => array('text'=>'Uppdatera',     'url'=>'movie_view_edit.php',      'title' => 'Uppdatera info om film'),
    'create'    => array('text'=>'Skapa',         'url'=>'movie_create.php',         'title' => 'Skapa ny film'),
    'delete'    => array('text'=>'Radera',        'url'=>'movie_view_delete.php',    'title' => 'Radera film'),
    'view'      => array('text'=>'Visa_komplett', 'url'=>'movie_view.php',           'title' => 'Kombinerat sökalternativ på en sida'),
  //  'stats'     => array('text'=>'Stats',         'url'=>'movie_cdatabase.php',      'title' => 'Statistik'),
    
 
       
          // This is a menu item of the submenu

        ),                     
      ),
        ),
      
     
      'blogger'     => array(
          'text'=>'Bloggsida',     
          'url'=>'blogg.php',    
          'title' => 'Blogga',
          
         'submenu' => array(          
          
          
           'items' => array(
    'hem'       => array('text'=>'Innehåll',   
        'url'=>'blogg_view.php',       
        'title' => 'Bloggen'
        ),
    'reset'     => array(
        'text'=>'Återställ',     
        'url'=>'blogg_reset.php',          
        'title' => 'Återställ'
        ),
     'login'     => array(
         'text'=>'Login',        
         'url'=>'movie_login.php',          
         'title' => 'Logga in för att ändra i databasen'
         ),
    'logout'    => array('text'=>'Logout',       
        'url'=>'movie_logout.php',         
        'title' => 'Logga ut'
        ),
  
      ),
     ),
    ),
             
     'kallkod'   => array(
         'text'=>'Källkod',       
         'url'=>'source.php',              
         'title' => 'Se källkoden'
         ),

    'kallkod'      => array(
        'text'=>'Källkod',     
        'url'=>'source.php',     
        'title' => 'Se källkoden'
        ),
      ),
   
 
 
  // This is the callback tracing the current selected menu item base on scriptname
  'callback' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
    
    
    );
    
    
/*
$bwix['navbarBlogg'] = array(

  'class' => 'nb-plain2',
//	 'class' => 'navbar',
  'items' => array(
    'hem'       => array('text'=>'Innehåll',   'url'=>'blogg_view.php',        'title' => 'Bloggen'),
    'reset'     => array('text'=>'Återställ',     'url'=>'blogg_reset.php',          'title' => 'Återställ'),
     'login'     => array('text'=>'Login',         'url'=>'movie_login.php',          'title' => 'Logga in för att ändra i databasen'),
    'logout'    => array('text'=>'Logout',        'url'=>'movie_logout.php',         'title' => 'Logga ut'),
  
      
     'kallkod'   => array('text'=>'Källkod',       'url'=>'source.php',               'title' => 'Se källkoden'),
  ),
  'callback_selected' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);
*/
    /*
$bwix['navbarFilm'] = array(

  'class' => 'nb-plain2',
//	 'class' => 'navbar',
 //   	 'class' => 'navbarx',
  'items' => array(
    'hem'       => array('text'=>'Alla filmer',   'url'=>'movie_connect.php',        'title' => 'Alla filmer'),
    'reset'     => array('text'=>'Återställ',     'url'=>'movie_reset.php',          'title' => 'Återställ'),
      /*
    'titel'     => array('text'=>'Sök titel',     'url'=>'movie_search_title.php',   'title' => 'Sök film per titel'),
    'year'      => array('text'=>'Sök per år',    'url'=>'movie_search_by_year.php', 'title' => 'Sök film per år'),
    'genre'     => array('text'=>'Sök per genre', 'url'=>'movie_by_genre.php',       'title' => 'Sök film per genre'),
    'page'      => array('text'=>'Paginering',    'url'=>'movie_page.php',           'title' => 'Dela upp resultatet på sidor'),
      
    //---------------------
      

      
      //------------------------------
      
    'sort'      => array('text'=>'Sortera',       'url'=>'movie_sort.php',           'title' => 'Sortera per kolumn'),
    'login'     => array('text'=>'Login',         'url'=>'movie_login.php',          'title' => 'Logga in för att ändra i databasen'),
    'logout'    => array('text'=>'Logout',        'url'=>'movie_logout.php',         'title' => 'Logga ut'),
    'edit'      => array('text'=>'Uppdatera',     'url'=>'movie_view_edit.php',      'title' => 'Uppdatera info om film'),
    'create'    => array('text'=>'Skapa',         'url'=>'movie_create.php',         'title' => 'Skapa ny film'),
    'delete'    => array('text'=>'Radera',        'url'=>'movie_view_delete.php',    'title' => 'Radera film'),
    'view'      => array('text'=>'Visa_komplett', 'url'=>'movie_view.php',           'title' => 'Kombinerat sökalternativ på en sida'),
  //  'stats'     => array('text'=>'Stats',         'url'=>'movie_cdatabase.php',      'title' => 'Statistik'),
    'kallkod'   => array('text'=>'Källkod',       'url'=>'source.php',               'title' => 'Se källkoden'),
  ),
  'callback_selected' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);
*/

 /*   
    $bwix['navbarOld'] = array(

 'class' => 'nb-plain',
//	 'class' => 'navbar',
 //    'class' => 'navbarx',
  'items' => array(
    'hem'          => array('text'=>'Hem',          'url'=>'me.php',          'title' => 'Min presentation om mig själv'),
    'redovisning'  => array('text'=>'Redovisning',  'url'=>'redovisning.php', 'title' => 'Redovisningar för kursmomenten'),
    'tarningsspel' => array('text'=>'Tärningsspel', 'url'=>'tarning.php',     'title' => 'SpelaTärning'),   
          'pflimmer'     => array('text'=>'Pflimmer',     'url'=>'pflimmer.php',    'title' => 'KollaFilm'),    
      'blogger'     => array('text'=>'Bloggsida',     'url'=>'blogg.php',    'title' => 'Blogga'), 
    'kallkod'      => array('text'=>'Källkod',      'url'=>'source.php',      'title' => 'Se källkoden'),

  ),
  'callback_selected' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);

*/
