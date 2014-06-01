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
dumpa($hurray);

$outputres = "";

//echo "Tvaan <br>";
if(isset($_POST['restore']) || isset($_GET['restore'])) {		
	
    
    $cmd = "$mysql -h {$host} -u {$login} -p {$password} < $sql 2>&1";
	//$cmd = "$mysql -h{$host} -u{$login}  -p{$password} < $sql";
        $res = exec($cmd);
        dumpa($res);
	$outputres = "<p>Databasen är återställd via kommandot<br/><code>{$cmd}</code></p><p>{$res}</p>";
        
        
       // echo $output;
	//dumpa($cmd);
        echo "<br>www<br>";
           //     $output2 = $bloggContent->ReCreateTableWithContent($hurray) ;
        echo "<br>zzz";
        echo "<br> output" . $output ;
        
        }
// Do it and store it all in variables in the Anax container.
        
       
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
{$outputres}
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