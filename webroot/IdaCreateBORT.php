<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.  
include(__DIR__.'/config.php');   
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
if (!isset($_SESSION)) { session_start(); }
//$bwix['stylesheets'][] = 'css/table.css';  
//$bwix['stylesheets'][] = 'css/form.css';  

$db = new CDatabase($bwix['database2']);  
$bloggContent = new CContent($db);  


//echo "<br> bloggContent <br>";
//dumpa($bloggContent);
$output="";  
//echo "<br> acronym  " . $acronym;
$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;   
//echo "<br> acronym  " . $acronym;
// Check that incoming parameters are valid  
isset($acronym) or header("Location: error.php");  
//isset($acronym) or die('Check: You must login to create.');  
//is_numeric($id) or die('Check: Id must be numeric.');  
//echo "<br> doCreate <br>";
if(isset($_POST['doCreate']))   
{   
    echo "<br> Do create <br>";
    $output = $db->createNew22();   
}   

$bwix['title'] = "Skapa ny page eller post";   

$bwix['main'] = <<<EOD
<h1>{$bwix['title']}</h1>  
<form method=post>   
<fieldset>   
<legend><b>Skapa ny page eller post</b></legend>   
<p><label>Titel:<br/><input type='text' required value="" name='title'/></label></p>   
<p><input type='submit' name='doCreate' value='Spara'/></p>   
{$output}   
</fieldset>   
</form>   
EOD;


// Finally, leave it all to the rendering phase of Adaras.   
include(BWI_THEME_PATH); 
