<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.



include(__DIR__.'/config.php'); 
  session_start(); 
if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}
$dump = $hand->StartSessions();
$dest = $hand->GetInitStarter();


include("tarning.adder1.php");
include(BWI_THEME_PATH);
//echo $temp;
/*
if(isset($_SESSION['dump'])) {
  $test = $_SESSION['dump'];
}
else {
	$test = new CDump(1);
  $_SESSION['dump'] = $test;
}
echo "<p>DEBUG: " . session_name();
echo "<P>DEBUG: " . session_id();
//echo "-------" . $init;
echo "<p>Allt innehåll i arrayen \$_SESSION:<br><pre>" . 
htmlentities(print_r($_SESSION, 1)) . "</pre>";
*/

