<?php  
/** 
 * 
 * 
 */ 




// Include the essential config-file which also creates the $paratus variable with its defaults. 
include(__DIR__.'/config.php');  
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }



//Create objects to access the database and userhandling 

$db = new CDatabase($bwix['database']); 

/*
if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  //echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "logge new";
}
*/

$user = new CUser(); 

// Check if user is authenticated. 

if($user->GetAcronym()) 
{ 
    $output = "Du är inloggad som " . $user->GetAcronym() . "."; 
} 
else 
{ 
    $output = "Du är INTE inloggad."; 
} 

if(isset($_POST['login']))  
{ 
    $user->Login($_POST['acronym'], $_POST['password'], $db); 
} 

// Do it and store it all in variables in the Paratus container. 
$bwix['title'] = 'Login'; 

$bwix['main'] = <<<EOD
<article class = "posts"> 
<h1>{$bwix['title']}</h1> 
<form method=post> 
  <fieldset> 
  <legend>Login</legend> 
  <p><em>Du kan logga in med doe:doe eller admin:admin.</em></p> 
  <p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p> 
  <p><label>Lösenord:<br/><input type='password' name='password' value=''/></label></p> 
  <p><input type='submit' name='login' value='Login'/></p> 
  <p><a href='movie_logout.php'>Logout</a></p> 
  <output><b>{$output}</b></output> 
  </fieldset> 
</form> 
{$bwix['byline']} 
</article> 
EOD;

// Finally, leave it all to the rendering phase of Anax. 
include(BWI_THEME_PATH); 
