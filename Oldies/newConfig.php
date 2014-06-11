<?php 
/** 
 * Config-file for Paratus. Change settings here to affect installation. 
 * 
 */ 
  
/** 
 * Set the error reporting. 
 * 
 */ 
error_reporting(-1);              // Report all type of errors 
ini_set('display_errors', 1);     // Display all errors  
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly 
  
  
/** 
 * Define Paratus paths. 
 * 
 */ 
define('PARATUS_INSTALL_PATH', __DIR__ . '/..'); 
define('PARATUS_THEME_PATH', PARATUS_INSTALL_PATH . '/theme/render.php'); 
  
  
/** 
 * Include bootstrapping functions. 
 * 
 */ 
include(PARATUS_INSTALL_PATH . '/src/bootstrap.php'); 
  
  
/** 
 * Start the session. 
 **/  
  
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__)); 
session_start(); 

  
/** 
 * Create the Paratus variable. 
 * 
 */ 
$paratus = array(); 
  
  
/** 
 * Site wide settings. 
 * 
 */ 
$paratus['lang']         = 'sv'; 
$paratus['title_append'] = ' | Paratus en webbtemplate'; 

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


/* 
*Header 
* 
*/ 

$paratus['header'] = <<<EOD 
<img class='sitelogo' src='img/paratus.png' alt='Paratus Logo'/> 
<span class='sitetitle'>Paratus webbtemplate</span> 
<span class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</span> 
EOD; 

/* 
 *Footer 
 * 
*/  
$paratus['footer'] = <<<EOD 
<footer><span class='sitefooter'>Copyright (c) Fred Bergklo (fredbergklo@gmail.com) | <a href='https://github.com/mosbth/Anax-base'>Anax på GitHub</a>  
| <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer> 
EOD; 

/* 
*Byline 
* 
*/ 
$paratus['byline'] = <<<EOD 
<footer class="byline"> 
  <figure class="right"><img src="img/fred_s.jpg" alt="Närbild Fred"> 
    <figcaption>Fred Bergklo</figcaption> 
  </figure> 
  <p>Fred Bergklo har studerat sociologi och spelprogrammering tidigare, och studerar just nu 
 webbprogrammering. Han jobbar extra på ICA, samt är involverad i projektet "Sommar Högskolan" 
 på Södertörns Högskola.</p> 

  <nav> 
    <ul class='icons'> 
      <li><a href='https://www.facebook.com/fred.bergstrom.5'><img src='/img/glyphicons/png/glyphicons_390_facebook.png' alt='facebook-icon' title='Fred Bergklo på Facebook' width='24' height='24'/></a></li> 
    </ul> 
  </nav> 

</footer> 
EOD; 

/** 
 * Theme related settings. 
 * 
 */ 
$paratus['stylesheets'] = array('css/style.css'); 
$paratus['favicon']    = 'favicon.ico'; 

/** 
 * Settings for JavaScript. 
 * 
 */ 
$paratus['modernizr'] = 'js/modernizr.js'; 
$paratus['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'; 
//$paratus['jquery'] = null; // To disable jQuery 
$paratus['javascript_include'] = array(); 
//$paratus['javascript_include'] = array('js/main.js'); // To add extra javascript files 

/** 
 * Settings for the database. 
 * 
 */ 

 $local = false; 
     
if($local) 
{ 
    $paratus['database']['dsn']            = 'mysql:host=localhost;dbname=kmom05;'; 
    $paratus['database']['username']       = 'root'; 
    $paratus['database']['password']       = '';   
    $paratus['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 
} 
else 
{ 
    $paratus['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=frbe14;'; 
    $paratus['database']['username']       = 'frbe14'; 
    $paratus['database']['password']       = 'O7r!n_F2';   
    $paratus['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 
}  
/** 
 * Google analytics. 
 * 
 */ 
$paratus['google_analytics'] = 'UA-22093351-9'; // Set to null to disable google analytics 

?> 