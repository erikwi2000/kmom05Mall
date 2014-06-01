<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }

// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";

//session_start(); 
//echo "aaaaaaaaaaaaa";
// set the value of the session variable 'foo'
$_SESSION['foo']='  bar     ---    '; 
$tt = $_SESSION['foo'];
$_SESSION['navbar2']='pflimmer'; 
// echo a little message to say it is done
//echo $_SESSION['foo'] . $_SESSION['navbar2'];
//echo 'Setting value of foo' . $tt; 
//$acronym = isset($_SESSION['user']) ?  $_SESSION['user']->acronym : null;
//echo "user-  " . $test;


if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "logge old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "loggenew";
}


if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}


//*

/*
if(isset($_SESSION['CDatabase'])) {
  $db = $_SESSION['CDatabase'];
		//dumpa($db);
}
else {
	$db = new CDatabase($bwix['database']);
//	dumpa($db);
  $_SESSION['CDatabase'] = $db;
}

*/
//echo "wwwwwwwwwwwwwwwww";

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




//$fromdb = $handle->GetDBasePflimmerStart($bwix['database']);
//$db = new CDatabase($bwix['database']);

//$db = new CDatabase($bwix['database']);
//$_SESSION['cdatabase'] = $db;
$bwix['title'] = "STARTA FILMANDE";

$bwix['main']  = <<<EOD
<h1>{$bwix['title']}</h1>
EOD;




$bwix['main'] = <<<EOD
<br><h3>{$output}</h3>
{$bwix['byline']}

EOD;


// Finally, leave it all to the rendering phase of BWi.
//echo BWI_THEME_PATH;
include(BWI_THEME_PATH);