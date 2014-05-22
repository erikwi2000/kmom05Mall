<!doctype html>
<html class='no-js' lang='sv'>
<head>
<meta charset='utf-8'/>
<title>Login | Min Filmdatabas</title>
<link rel='shortcut icon' href='favicon.ico'/><link rel='stylesheet' type='text/css' href='css/style.css'/>
<script src='js/modernizr.js'></script>
</head>
<body>
  <div id='wrapper'>
    <div id='header'><img class='sitelogo' src='img/anax.png' alt='Anax Logo'/>
<span class='sitetitle'>Min Filmdatabas</span>
<span class='siteslogan'>Kodexempel för hur man gör sin egen filmdatabas sökbar</span></div>
    <div id='navbar'><nav>
<ul class='nb-plain'>
<li><a href='movie_connect.php' title='Alla filmer'>Alla filmer</a></li>
<li><a href='movie_reset.php' title='Återställ'>Återställ</a></li>
<li><a href='movie_search_title.php' title='Sök film per titel'>Sök titel</a></li>
<li><a href='movie_search_by_year.php' title='Sök film per år'>Sök per år</a></li>
<li><a href='movie_by_genre.php' title='Sök film per genre'>Sök per genre</a></li>
<li><a href='movie_sort.php' title='Sortera per kolumn'>Sortera</a></li>
<li><a href='movie_page.php' title='Dela upp resultatet på sidor'>Paginering</a></li>
<li class='selected' ><a href='movie_login.php' title='Logga in för att ändra i databasen'>Login</a></li>
<li><a href='movie_logout.php' title='Logga ut'>Logout</a></li>
<li><a href='movie_view_edit.php' title='Uppdatera info om film'>Uppdatera</a></li>
<li><a href='movie_create.php' title='Skapa ny film'>Skapa</a></li>
<li><a href='movie_view_delete.php' title='Radera film'>Radera</a></li>
<li><a href='movie_view.php' title='Kombinerat sökalternativ på en sida'>Visa komplett</a></li>
<li><a href='source.php' title='Se källkoden'>Källkod</a></li>
</ul>
</nav>
</div>    <div id='main'><h1>Login</h1>

<form method=post>
  <fieldset>
  <legend>Login</legend>
  <p><em>Du kan logga in med doe:doe eller admin:admin.</em></p>
  <p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p>
  <p><label>Lösenord:<br/><input type='text' name='password' value=''/></label></p>
  <p><input type='submit' name='login' value='Login'/></p>
  <p><a href='movie_logout.php'>Logout</a></p>
  <output><b>Du är INTE inloggad.</b></output>
  </fieldset>
</form>
</div>
    <div id='footer'><footer><span class='sitefooter'>Copyright (c) Mikael Roos (me@mikaelroos.se) | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer></div>
      </div>



<script>
  var _gaq=[['_setAccount','UA-22093351-1'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>
</html>
