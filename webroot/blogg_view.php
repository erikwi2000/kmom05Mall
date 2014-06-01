<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 /* This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }
/**
 * Create a link to the content, based on its type.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
 
function getUrlToContent($content) {
  switch($content->type) {
    case 'page': return "blogg_page.php?url={$content->url}"; break;
    case 'post': return "blogg_blog.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}
//echo "ee";

// Connect to a MySQL database using PHP PDO
$db = new CDatabase($bwix['database2']);


    
 if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "loggenew";
}   
$rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];

/*
if($user->GetAcronym()) 
{ 
    $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
} 
else 
{ 
    $output = "Du är INTE inloggad."; 
} 

*/
// Get all content
$sql = '
  SELECT *, (published <= NOW()) AS available
  FROM Content;
';
$res = $db->ExecuteSelectQueryAndFetchAll($sql);

// Put results into a list
$items = null;
foreach($res AS $key => $val) {
      $items .= "<li>{$val->type} (" . 
              (!$val->available ? 'inte ' : null) . 
              "publicerad): " . htmlentities($val->title, null, 'UTF-8') . 
              " (<a href='blogg_edit.php?id={$val->id}'>editera</a> <a href='" .
              getUrlToContent($val) . "'>visa</a>)</li>\n";
}
$output ="<br><h3>" . $output . "</h3>";

// Do it and store it all in variables in the Anax container.
$bwix['title'] = "Visa allt innehåll";
$bwix['debug'] = $db->Dump();

$bwix['main'] = <<<EOD
{$output}
<h1>{$bwix['title']}</h1>

<p>Här är en lista på allt innehåll i databasen.</p>

<ul>
{$items}
</ul>

<p><a href='blogg_blog.php'>Visa alla bloggposter.</a></p>

EOD;



// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);