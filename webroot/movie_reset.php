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

// Do it and store it all in variables in the BWi container.
//$bwix['title'] = "Pflimmer";
//echo getCurrentUrl();

/*

$hej = $bwix['database'];
//----------------------------------------
try {
  $pdo = new PDO($hej['dsn'], $hej['username'], $hej['password'], $hej['driver_options']);	
}
catch(Exception $e) {
  //throw $e; // For debug purpose, shows all connection details
  throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
}

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
*/
//--------------------------------------
//=========================================
 

  //  $pluppas = isset($_SESSION['user']) ? "Du är inloggad!" : "Du är INTE inloggad!";
   // $action =  isset($_SESSION['user']) ? TRUE : FALSE;
    
    
    
    
 /*   
if($action) {echo "pluppa2" . $pluppas;}
if(!$action) {echo "pluppa2NOT" . $pluppas;}
*/

 /*   
    
    if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
 // echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "loggenew";
}
    */
    
    
    //$pluppas = $log->CheckLoggedIn($bwix['database']);
    //$action = $log->CheckLoggedInBool($bwix['database']);
    $action =  isset($_SESSION['user']) ? TRUE : FALSE;
    
//echo "<br>ssssssssssssssssss<br>" . $pluppas;
    
    
    
if(isset($_SESSION['filmhandle'])) {
  $handle = $_SESSION['filmhandle'];
}
else {
	$handle = new CFilmHandle();
  $_SESSION['filmhandle'] = $handle;
}
/*
if(isset($_SESSION['user']->LoggedIn)){echo $_SESSION['user']->LoggedIn;}
 else {
    echo "Not logged in";
    $activity = FALSE;
 }
*/


//echo $_SESSION['logge']->pricken . "  In movie_reset <br>";
// Restore the database to its original settings
$sql      = 'movie.sql';
$host     = 'localhost';
$output = null;


$mysql    = 'C:\xampp\mysql\bin\mysql.exe';
$login    = '';
$password = '';

//echo "Tvaan <br>";
if(isset($_POST['restore']) || isset($_GET['restore'])) {		
	$cmd = "$mysql -h {$host} -u {$login} -p{$password} < $sql 2>&1";
	$cmd = "$mysql -h {$host} -u {$login}  -p{$password} < $sql";
        $res = exec($cmd);
	$output = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p><p>{$res}</p>";
	}
// Do it and store it all in variables in the Anax container.
        
        
 

if(isset($_SESSION['logge'])) {
  $log = $_SESSION['logge'];
 // echo "logge old";
}
else {
	$log = new CUser();
  $_SESSION['logge'] = $log;
  //echo "loggenew";
}

//Check of logged in
$pluppas = $log->CheckLoggedIn($bwix['database']);       
        
        

$bwix['title'] = "Återställ (databasen till ursprungligt skick)";
//$bwix['main'] 
        
        if($action){
            $insert = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>$pluppas</h3>
<form method=post>
<input type=submit name=restore value='Återställ databasen'/>
<output>{$output}</output>
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