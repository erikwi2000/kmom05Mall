<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix 
//variable with its defaults.
include(__DIR__.'/config.php'); 
include(__DIR__.'/filter.php'); 



session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Bloggar";


    $action =  isset($_SESSION['user']) ? TRUE : FALSE;
    

    
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
$db = new CDatabase($bwix['database2']);
  $bloggContent = new CContent($bwix['database2']);


//echo $_SESSION['logge']->pricken . "  In movie_reset <br>";
// Restore the database to its original settings
  
  

  
  
$sql      = 'reset.sql';
$host     = 'localhost';
$output = null;


$mysql    = 'C:\xampp\mysql\bin\mysql.exe';
$login    = '';
$password = '';



  $hurray = [
    "sql"    => $sql,
    "host"  => $host,
    "output"  => null,  
    "mysql"  => $mysql,
    "login"  => $login,
    "password"  => $password,
];
//dumpa($hurray);

$output2 = "";

//echo "Tvaan <br>";
if(isset($_POST['restore']) || isset($_GET['restore'])) {		
                $output2 = $bloggContent->ReCreateTableWithContent($hurray) ; 
        }
// Do it and store it all in variables in the Anax container.
 
 if(isset($_POST['restoreInside']) || isset($_GET['restoreInside'])) {       
        $output2 = CreateTableWithContent() ;      
 }
 $rrc = array(0 => "D",);
$rrc = $user->GetUserLoginStatus();
  $output = $rrc[0];
  $way = $rrc[1];       
        
        
$bwix['title'] = "Återställ databasen <br>(till ursprungligt skick)";
//$bwix['main'] 
        
        if($action){
            $insert = <<<EOD
<h1>{$bwix['title']}</h1>
<h3>$output</h3>
<form method=post>
<input type=submit name=restore value='Återställ databasen'/>
{$output2}
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