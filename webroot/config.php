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


/** * Define BWi paths.
 *
 */
 //echo "<br> Dir <br>" . __DIR__ . "<br>";
define('BWI_INSTALL_PATH', __DIR__ . '/../');
//echo "BWI install path <br>" . BWI_INSTALL_PATH . "</br>";
define('BWI_THEME_PATH', BWI_INSTALL_PATH . 'theme/render.php');
//echo  "BWI theme path <br>" . BWI_THEME_PATH . "</br>";
//	var_dump(BWI_THEME_PATH);
//session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();

include(BWI_INSTALL_PATH . '/src/bootstrap.php');
//echo "<br>BWI install path <br>" .  BWI_INSTALL_PATH;
//echo BWI_INSTALL_PATH . '/src/bootstrap.php';

$bwix = array();

/**
 * Settings for the database.
 *
 */
/*
 *  LOCAL DATA
$bwix['databaseHOME']['dsn']            = 'mysql:host=localhost;dbname=Movie;';
$bwix['databaseHOME']['username']       = 'bjvi13';
$bwix['databaseHOME']['password']       = '';
$bwix['databaseHOME']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
*/
/*
 * SERVER DATA
$bwix['databaseAWAY']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=Movie;';
$bwix['databaseAWAY']['username']       = 'bjvi13';
$bwix['databaseAWAY']['password']       = '787xQ]i9';
$bwix['databaseAWAY']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
 */

// INCLUDE PATHS TO db DATA

include(__DIR__ . '/databaseHOME.php');
//include(__DIR__ . '/databaseAWAY.php');
$bwix['database2']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 




$bwix['lang']         = 'sv';
$bwix['title_append'] = ' | kmom05';
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
  width: 80%;
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

include('navbarInsert.php');
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