<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include(__DIR__.'/config.php');   

//$adaras['stylesheets'][] = 'css/table.css';  
//$adaras['stylesheets'][] = 'css/form.css';  

$db = new CDatabase($bwix['database2']);  
$content = new CContent($db);  
$output="";  

$acronym = isset($_SESSION['user']) ? $_SESSION['user']->acronym : null;   

// Check that incoming parameters are valid  
isset($acronym) or header("Location: error.php");  
//isset($acronym) or die('Check: You must login to create.');  
//is_numeric($id) or die('Check: Id must be numeric.');  

if(isset($_POST['doCreate']))   
{   
    $output = $content->createNew();   
}   

$adaras['title'] = "Skapa ny page eller post";   

$bwix['main'] = <<<EOD
<h1>{$adaras['title']}</h1>  
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