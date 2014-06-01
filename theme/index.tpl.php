<!DOCTYPE html>
<html class='no-js' lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<title><?=get_title($title)?></title>
<?php if(isset($favicon)): ?><link rel='icon' href='<?=$favicon?>'/><?php endif; ?>
<?php foreach($stylesheets as $val): ?>
<?php if(isset($inlinestyle)): ?><style><?=$inlinestyle?></style><?php endif; ?>
<link rel='stylesheet' type='text/css' href='<?=$val?>'/>
<?php endforeach; ?>
<script src='<?=$modernizr?>'></script>
</head>
<body>
  <div id='wrapper'>
    <div id='header'><?=$header?></div> 
 		<?php if(isset($navbar)): ?>
    <div id='navbar'><?=get_navbar($navbar)?></div>
        <?php endif; ?>
                  
 <?php 
 
//dumpa($navbarFilm) ;
 if(isset($_SESSION['navbar2'])) {
    // echo $_SESSION['navbar2'];           
          if($_SESSION['navbar2'] == "blogg"): ?>
    <div id='navbarBlogg'><?=get_navbar($navbarBlogg)?></div>
       <?php endif; }?>
                
  <?php              
//dumpa($navbarFilm) ;
 if(isset($_SESSION['navbar2'])) {
    // echo $_SESSION['navbar2'];
   if($_SESSION['navbar2'] == "pflimmer"): ?>
    <div id='navbarFilm'><?=get_navbar($navbarFilm)?></div>
       <?php endif; }?>
            
		

    <div id='main'><?=$main?></div>

    <div id='footer'><?=$footer?></div>

    <?php if(isset($debug)): ?><div id='debug'><?=$debug?></div><?php endif; ?>
  </div>

<?php if(isset($jquery) && isset($jquery_src)):?><script src='<?=$jquery_src?>'></script><?php endif; ?>

<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
<script src='<?=$val?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($google_analytics)): ?>
<script>
  var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>


</body>
</html>
