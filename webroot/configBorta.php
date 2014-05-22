<?php
/**
 * Config-file for BWi.  Change  settings here to affect installation.
 *
 */



/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();
/** * Define BWi paths.
 *
 */
define('BWI_INSTALL_PATH', __DIR__ . '/../');
define('BWI_THEME_PATH', BWI_INSTALL_PATH . 'theme/render.php');
//session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
include(BWI_INSTALL_PATH . '/src/bootstrap.php');
$bwix = array();
/**
 * Settings for the database.
 *
 * 
 
 $dsn      = 'mysql:host=blu-ray.student.bth.se;dbname=Movie;';
//$dsn      = 'mysql:host=localhost;dbname=Movie;';
$login    = 'bjvi13';
$password = '787xQ]i9';
//$password = ''; 
 
 * 
 * 
 */
$bwix['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=Movie;';
//$bwix['database']['dsn']            = 'mysql:host=localhost;dbname=Movie;';
$bwix['database']['username']       = 'bjvi13';
//$bwix['database']['username']       = 'bjvi13';
$bwix['database']['password']       = '787xQ]i9';
//$bwix['database']['password']       = '';
$bwix['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
 
$bwix['lang']         = 'sv';
$bwix['title_append'] = ' | oophp';
$bwix['stylesheets'] = array('css/webb.css');
$bwix['stylesheets'] = array('css/style.css');
//-------------------------
$bwix['inlinestyle'] = "
.orderby a {
  text-decoration: none;
  color: black;
}

.dbtable {

}

.dbtable table {
  width: 100%;
}

.dbtable .rows {
  text-align: right;
}

.dbtable .pages {
  text-align: center;
}

.debug {
  color: #666;
}

label {
  font-size: smaller;
}

input[type=text] {
  width: 300px;
}

select {
  height: 10em;
}
";

//------------------------------
$bwix['favicon']    = 'img/me1favicon.png';
//<link rel='icon' href='img/me1favicon.png' >
$bwix['header'] = <<<EOD
<img class='sitelogo' src='img/oophp.png' alt='oophp Logo'/>
<span class='sitetitle'>Me oophp</span>
<span class='siteslogan'>Min Me-sida i kursen Databaser och Objektorienterad PHP-programmering</span>
        

EOD;
//dump('header');
$bwix['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Björn Viklund (bjvi13@student.bth.se) |
 Björn Wiklund (erikwi2000@gmail.com)  | 
 <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

$bwix['byline'] = <<<EOD
<footer class="byline">
  <figure class="right"><img src="img/me/me.jpg" alt="Börnen">
    <figcaption>En liten Björn.</figcaption>
  </figure>
  <p>Björn läser webbprogrammering vid Blekinge Tekniska Högskola. 
</p>

  <nav>
    <ul class="icons">
      <li><a href='https://plus.google.com/+bjornwiklund_privat/about'><img src='img/glyphicons/png/glyphicons_362_google+_alt.png' alt='google+-icon' title='Björn Viklund på Google+' width='24' height='24'/></a></li>
      <li><a href='http://se.linkedin.com/in/erikwi2000'><img src='img/glyphicons/png/glyphicons_377_linked_in.png' alt='linkedin-icon' title='Björn Viklund på LinkedIn' width='24' height='24'/></a></li>
      <li><a href='https://www.facebook.com/oldman24'><img src='img/glyphicons/png/glyphicons_390_facebook.png' alt='facebook-icon' title='Björn Viklund på Facebook' width='24' height='24'/></a></li>
      <li><a href='https://twitter.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_392_twitter.png' alt='twitter-icon' title='Björn Viklund på Twitter' width='24' height='24'/></a></li>
 <!-- <li><a href='http://mikaelroos.se/youtube'><img src='img/glyphicons/png/glyphicons_382_youtube.png' alt='youtube-icon' title='Björn Viklund på YouTube' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/flickr'><img src='img/glyphicons/png/glyphicons_395_flickr.png' alt='flickr-icon' title='Björn Viklund på Flickr' width='24' height='24'/></a></li>
  -->
      <li><a href='http://instagram.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_412_instagram.png' alt='instagram-icon' title='Björn Viklund på Instagram' width='24' height='24'/></a></li>
      <li><a href='https://github.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_381_github.png' alt='github-icon' title='Björn Viklund på GitHub' width='24' height='24'/></a></li>
    	
    </ul>
  </nav>
</footer>
EOD;

/**
 * The navbar
 *
 */

$bwix['navbarFilm'] = array(

  'class' => 'nb-plain2',
//	 'class' => 'navbar',
  'items' => array(
 //   'hem'       => array('text'=>'Alla filmer',   'url'=>'movie_connect.php',        'title' => 'Alla filmer'),
    'reset'     => array('text'=>'Återställ',     'url'=>'movie_reset.php',          'title' => 'Återställ'),
  //  'titel'     => array('text'=>'Sök titel',     'url'=>'movie_search_title.php',   'title' => 'Sök film per titel'),
  //  'year'      => array('text'=>'Sök per år',    'url'=>'movie_search_by_year.php', 'title' => 'Sök film per år'),
  //  'genre'     => array('text'=>'Sök per genre', 'url'=>'movie_by_genre.php',       'title' => 'Sök film per genre'),
  //  'sort'      => array('text'=>'Sortera',       'url'=>'movie_sort.php',           'title' => 'Sortera per kolumn'),
  //  'page'      => array('text'=>'Paginering',    'url'=>'movie_page.php',           'title' => 'Dela upp resultatet på sidor'),
    'login'     => array('text'=>'Login',         'url'=>'movie_login.php',          'title' => 'Logga in för att ändra i databasen'),
    'logout'    => array('text'=>'Logout',        'url'=>'movie_logout.php',         'title' => 'Logga ut'),
    'edit'      => array('text'=>'Uppdatera',     'url'=>'movie_view_edit.php',      'title' => 'Uppdatera info om film'),
    'create'    => array('text'=>'Skapa',         'url'=>'movie_create.php',         'title' => 'Skapa ny film'),
    'delete'    => array('text'=>'Radera',        'url'=>'movie_view_delete.php',    'title' => 'Radera film'),
    'view'      => array('text'=>'Visa_komplett', 'url'=>'movie_view.php',           'title' => 'Kombinerat sökalternativ på en sida'),
    'kallkod'   => array('text'=>'Källkod',     'url'=>'source.php',      'title' => 'Se källkoden'),
  ),
  'callback_selected' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);

$bwix['navbar'] = array(

  'class' => 'nb-plain',
//	 'class' => 'navbar',
  'items' => array(
    'hem'          => array('text'=>'Hem',          'url'=>'me.php',          'title' => 'Min presentation om mig själv'),
    'redovisning'  => array('text'=>'Redovisning',  'url'=>'redovisning.php', 'title' => 'Redovisningar för kursmomenten'),
    'tarningsspel' => array('text'=>'Tärningsspel', 'url'=>'tarning.php',     'title' => 'SpelaTärning'),   
    'pflimmer'     => array('text'=>'Pflimmer',     'url'=>'pflimmer.php',    'title' => 'KollaFilm'),    
    'kallkod'      => array('text'=>'Källkod',      'url'=>'source.php',      'title' => 'Se källkoden'),
  ),
  'callback_selected' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
);


/**
 * Theme related settings.
 *
 */
//$bwix['stylesheet'] = 'css/style.css';
$bwix['stylesheets'] = array('css/style.css');
$bwix['favicon']    = 'img/me1favicon.png';
$bwix['inlinestyle']    = null;
//xxxxx$bwix['favicon']    = 'favicon_oophp.ico';

$bwix['stylesheets'][] = 'css/dice.css'; 

// Do it and store it all in variables in the BWi container.

$bwix['title'] = "Tärning";

/**
 * Settings for JavaScript.
 *
 */
$bwix['modernizr']  = 'js/modernizr.js';
$bwix['jquery']     = null; // To disable jQuery
$bwix['jquery_src'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
$bwix['javascript_include'] = array();
//$bwix['javascript_include'] = array('js/main.js'); // To add extra javascript files

//echo "At bottom of config";

/**
 * Google analytics.
 *
 */
$bwix['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics