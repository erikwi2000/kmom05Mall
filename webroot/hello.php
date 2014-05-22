<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 
//echo __DIR__;
 
// Do it and store it all in variables in the BWi container.
$bwix['title'] = "BWI";
 
$bwix['header'] = <<<EOD
<img class='sitelogo' src='img/favicon3.png' alt='BWi Logo'/>
<span class='sitetitle'>BWi webbtemplate</span>
<span class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</span>
EOD;
 
$bwix['main'] = <<<EOD
<h1>Hej Världen</h1>
<p>Detta är en exempelsida som visar hur BWi ser ut och fungerar.</p>
EOD;
 
$bwix['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Mikael Roos (me@mikaelroos.se) | <a href='https://github.com/mosbth/Anax-base'>Anax på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
 
 
// Finally, leave it all to the rendering phase of BWi.
include(BWI_THEME_PATH);