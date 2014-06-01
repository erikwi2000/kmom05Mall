<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Flimmer";




if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  //echo "user old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "usernew";
}


    $action =  isset($_SESSION['user']) ? TRUE : FALSE;
   
if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}


//echo $_SESSION['logge']->pricken . "  In movie_reset <br>";
// Restore the database to its original settings
$sql      = 'movie.sql';
$host     = 'localhost';
$output = null;


$mysql    = 'C:\xampp\mysql\bin\mysql.exe';
$login    = '';
$password = '';


$outputdbr = "";
//echo "Tvaan <br>";
if(isset($_POST['restore']) || isset($_GET['restore'])) {
    //  echo"Inside:  ";
	$cmd = "$mysql -h {$host} -u {$login} -p {$password} < $sql 2>&1";
	//$cmd = "$mysql -h {$host} -u {$login}  -p {$password} < $sql";
        // echo"Inside:  ";
        dumpa($cmd);
        $res = exec($cmd);
        // echo"Inside:  ";
	$outputdbr = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p><p>{$res}</p>";
	}
// Do it and store it all in variables in the Anax container.
        
        


if(isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
 // echo "user old";
}
else {
	$user = new CUser();
  $_SESSION['user'] = $user;
  //echo "usernew";
}


//Check of logged in
//$pluppas = $log->CheckLoggedIn($bwix['database']);       
 


        
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
 <output>{$output}</output> 
*/
$bwix['title'] = "Återställ Databasen <br>(till ursprungligt skick)";
//$bwix['main'] 
        
        if($action){
            $insert = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>$output</h3>
<form method=post>
<input type=submit name=restore value='Återställ databasen'/>
 <br><output>{$outputdbr}</output> 
</form>
EOD;
}
else {
$insert = <<<EOD
<h1>{$bwix['title']}</h1>
<h3> Tyvärr du måste logga in först för att återställa databasen.</h3>
EOD;
}

$bwix['title'] = "Återställ (databasen till ursprungligt skick)";
$trxx = <<<EOD
{$insert}
EOD;



//echo "<br>Tillbaka <br>";
$bwix['main'] = <<<EOD
{$trxx}
{$bwix['byline']}

EOD;


// Finally, leave it all to the rendering phase of Anax.
include(BWI_THEME_PATH);