<?php
/**
 * Config-file for Anax. Change settings here to affect installation.
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
 * Define Anax paths.
 *
 */
define('ANAX_INSTALL_PATH', __DIR__ . '/../../oophp/me/anax-oophp');
define('ANAX_THEME_PATH', ANAX_INSTALL_PATH . '/theme/render.php');


/**
 * Include bootstrapping functions.
 *
 */
include(ANAX_INSTALL_PATH . '/src/bootstrap.php');


/**
 * Start the session.
 *
 */
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();


/**
 * Create the Anax variable.
 *
 */
$anax = array();


/**
 * Site wide settings.
 *
 */
$anax['lang']         = 'sv';
$anax['title_append'] = ' | Innehåll i databasen';

$anax['header'] = <<<EOD
<img class='sitelogo' src='img/anax.png' alt='Anax Logo'/>
<span class='sitetitle'>Lagra webbsidans innehåll i databasen</span>
<span class='siteslogan'>Kodexempel hur man lagrar webbsidors innehåll i databasen</span>
EOD;

$anax['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Mikael Roos (me@mikaelroos.se) | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

$anax['byline'] = <<<EOD
<footer class="byline">
  <figure class="right"><img src="http://dbwebb.se/image/mikael-roos/me-happy.jpg?w=120&h=120&crop-to-fit&q=70" alt="Närbild Mikael">
    <figcaption>En glad Mikael.</figcaption>
  </figure>
  <p>Mikael Roos undervisar i databaser och webbprogrammering vid Blekinge Tekniska Högskola. Mikaels nyckelord äro, i nämnd ordning, SQL, PHP, HTML, JavaScript och CSS. MegaMic, som han även kallar sig, kör FreeBSD (Unix) på servrarna i garderoben och drömmer om sina (kommande) opensource-projekt.</p>

  <nav>
    <ul class='icons'>
      <li><a href='http://mikaelroos.se/googleplus'><img src='/img/glyphicons/png/glyphicons_362_google+_alt.png' alt='google+-icon' title='Mikael Roos på Google+' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/linkedin'><img src='/img/glyphicons/png/glyphicons_377_linked_in.png' alt='linkedin-icon' title='Mikael Roos på LinkedIn' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/facebook'><img src='/img/glyphicons/png/glyphicons_390_facebook.png' alt='facebook-icon' title='Mikael Roos på Facebook' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/twitter'><img src='/img/glyphicons/png/glyphicons_392_twitter.png' alt='twitter-icon' title='Mikael Roos på Twitter' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/youtube'><img src='/img/glyphicons/png/glyphicons_382_youtube.png' alt='youtube-icon' title='Mikael Roos på YouTube' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/flickr'><img src='/img/glyphicons/png/glyphicons_395_flickr.png' alt='flickr-icon' title='Mikael Roos på Flickr' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/github'><img src='/img/glyphicons/png/glyphicons_381_github.png' alt='github-icon' title='Mikael Roos på GitHub' width='24' height='24'/></a></li>
      <li><a href='http://mikaelroos.se/instagram'><img src='/img/glyphicons/png/glyphicons_412_instagram.png' alt='instagram-icon' title='Mikael Roos på Instagram' width='24' height='24'/></a></li>
    </ul>
  </nav>

</footer>
EOD;



/**
 * Settings for the database.
 *
 */
$anax['database']['dsn']            = 'mysql:host=localhost;dbname=Anaxoophp;';
$anax['database']['username']       = 'acronym';
$anax['database']['password']       = 'password';
$anax['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");



/**
 * The navbar
 *
 */
//$anax['navbar'] = null; // To skip the navbar
$anax['navbar'] = array(
  'class' => 'nb-plain',
  'items' => array(
    'hem'       => array('text'=>'Innehåll',     'url'=>'view.php',         'title' => 'Allt innehåll'),
    'reset'     => array('text'=>'Återställ',    'url'=>'reset.php',        'title' => 'Återställ'),
    'login'     => array('text'=>'Login',        'url'=>'login.php',        'title' => 'Logga in för att ändra i databasen'),
    'logout'    => array('text'=>'Logout',       'url'=>'logout.php',       'title' => 'Logga ut'),
    //'edit'      => array('text'=>'Uppdatera',     'url'=>'edit.php',         'title' => 'Uppdatera innehåll'),
/*
    'titel'     => array('text'=>'Sök titel',     'url'=>'movie_search_title.php',   'title' => 'Sök film per titel'),
    'year'      => array('text'=>'Sök per år',    'url'=>'movie_search_by_year.php', 'title' => 'Sök film per år'),
    'genre'     => array('text'=>'Sök per genre', 'url'=>'movie_by_genre.php',       'title' => 'Sök film per genre'),
    'sort'      => array('text'=>'Sortera',       'url'=>'movie_sort.php',           'title' => 'Sortera per kolumn'),
    'page'      => array('text'=>'Paginering',    'url'=>'movie_page.php',           'title' => 'Dela upp resultatet på sidor'),
    'create'    => array('text'=>'Skapa',         'url'=>'movie_create.php',         'title' => 'Skapa ny film'),
    'delete'    => array('text'=>'Radera',        'url'=>'movie_view_delete.php',    'title' => 'Radera film'),
    'view'      => array('text'=>'Visa komplett', 'url'=>'movie_view.php',           'title' => 'Kombinerat sökalternativ på en sida'),
*/
    'kallkod'   => array('text'=>'Källkod',       'url'=>'source.php',               'title' => 'Se källkoden'),
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
//$anax['stylesheet'] = 'css/style.css';
$anax['stylesheets'] = array('css/style.css');
$anax['inlinestyle'] = null;
$anax['favicon']     = 'favicon.ico';



/**
 * Settings for JavaScript.
 *
 */
$anax['modernizr']  = 'js/modernizr.js';
$anax['jquery']     = null; // To disable jQuery
$anax['jquery_src'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
$anax['javascript_include'] = array();
//$anax['javascript_include'] = array('js/main.js'); // To add extra javascript files



/**
 * Google analytics.
 *
 */
$anax['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics