<?php 
/** 
 * This is a bwix pagecontroller. 
 * 
 */ 
// Include the essential config-file which also creates the $bwix variable with its defaults. 
include(__DIR__.'/config.php');  

session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
//session_start();
if (!isset($_SESSION)) { session_start(); }
//Connect to db 
$db = new CDatabase($bwix['database']); 
$content = new CContent($db); 


//Get parameters 
$id = strip_tags($_GET['id']);  
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null; 

// Check that incoming parameters are valid  
isset($acronym) or header("Location: error.php"); 
is_numeric($id) or die('Check: Id must be numeric.');  

$outputB = null;  
$outputA = null;  
$title = null;  

if (!isset($_POST['delete']))   
{   
    $c = $content->SelectId($id);   
    $title  = htmlentities($c->title, null, 'UTF-8');   
}   
else   
{   
    $outputA = $content->deleteContent($id);   
    if ($outputA==null) {  
        $outputA="Det fungerade inte!";   
    }  
}  

$outputB = "Ta bort: " . $title; 


$bwix['title'] = "Radera inlägg"; 
$bwix['debug'] = $db->Dump();  


// Do it and store it all in variables in the bwix container. 
$bwix['main'] = <<<EOD
<article> 
<h1>{$bwix['title']}</h1> 
<form method=post>   
<h2>{$outputB}?</h2>  
<p>Säker på att du vill radera?</p>   
<input type='submit' name='delete' value='Radera'/>  
</form>   
<p>{$outputA}</p> 
  </article> 
   
EOD;


// Finally, leave it all to the rendering phase of bwix. 
include(BWI_THEME_PATH); 

