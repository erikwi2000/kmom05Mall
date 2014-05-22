<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bwix['main'] = $dump->GetAddPart1();
$statString = $hand->GetInputInfo2();
//$statString .= "bbbb";

$diceList = "";
if(!$dest){
 if($statString !== "NoActivitySet")    {
$diceList = $hand->GetRollsAsImageList(); 
 }
    else 
        {$statString = "";
        }
 
 }

 $dest = FALSE;
 if(isset($statString)) {}
 else {$statString= "";}
 
$bwix['main'] .= <<<EOD
{$diceList}
{$statString}
{$bwix['byline']}
 
EOD;
