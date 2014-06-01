<?php 
/**
 * This is a Bwix pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Logout";
/*
if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
  //echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "logge new";
}
*/

//Create objects to access the database and userhandling 
$db = new CDatabase($bwix['database']); 
$user = new CUser(); 
/*
// Do it and store it all in variables in the Anax container.
//$bwix['title'] = "Logout";
$_SESSION['logge']->pricken = 171717;
//echo $_SESSION['logge']->pricken;
echo $_SESSION['logge']->pricken . " pricken  In movie_logout <br>";
*/
//-----------------------------------

// Check if user is authenticated. 

if($user->GetAcronym()) 
{ 
  $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
} 
else 
{ 
  $output = "Du är INTE inloggad."; 
} 

// Logout the user 
if(isset($_POST['logout']))  
{ 
  $user->Logout(); 
} 




// Do it and store it all in variables in the Paratus container. 
$bwix['title'] = 'Logout'; 

$bwix['main'] = <<<EOD
<article class = "posts"> 
<h1>{$bwix['title']}</h1> 
<form method=post> 
  <fieldset> 
  <legend>Login</legend> 
  <p><input type='submit' name='logout' value='Logout'/></p> 
  <p><a href='movie_login.php'>Login</a></p> 
  <output><b>{$output}</b></output> 
  </fieldset> 
</form> 
{$bwix['byline']} 
</article> 
EOD;


// Finally, leave it all to the rendering phase of Bwix. 
include(BWI_THEME_PATH); 




