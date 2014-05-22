<!DOCTYPE html>
<html class='no-js' lang='sv'>
<head>
<meta charset='utf-8'/>
<title>Flimmer | oophp kursmaterial</title>
<link rel='icon' href='img/me1favicon.png'/><link rel='stylesheet' type='text/css' href='css/style.css'/>
<link rel='stylesheet' type='text/css' href='css/dice.css'/>
<script src='js/modernizr.js'></script>
</head>
<body>
  <div id='wrapper'>
    <div id='header'><img class='sitelogo' src='img/oophp.png' alt='oophp Logo'/>
<span class='sitetitle'>Me oophp</span>
<span class='siteslogan'>Min Me-sida i kursen Databaser och Objektorienterad PHP-programmering</span>
        
</div>
 
 		<div id='navbar'><nav>
<ul class='nb-plain'>
<li><a href='me.php' title='Min presentation om mig själv'>Hem</a></li>
<li><a href='redovisning.php' title='Redovisningar för kursmomenten'>Redovisning</a></li>
<li><a href='tarning.php' title='SpelaTärning'>Tärningsspel</a></li>
<li><a href='pflimmer.php' title='KollaFilm'>Pflimmer</a></li>
<li><a href='source.php' title='Se källkoden'>Källkod</a></li>
</ul>
</nav>
</div>
 <div id='navbarFilm'><nav>
<ul class='nb-plain2'>
<li><a href='movie_connect.php' title='Alla filmer'>Alla filmer</a></li>
<li><a href='movie_reset.php' title='Återställ'>Återställ</a></li>
<li><a href='movie_search_title.php' title='Sök film per titel'>Sök titel</a></li>
<li class='selected' ><a href='movie_search_by_year.php' title='Sök film per år'>Sök per år</a></li>
<li><a href='movie_by_genre.php' title='Sök film per genre'>Sök per genre</a></li>
</ul>
<ul  class='nb-plain2'>
<li><a href='movie_sort.php' title='Sortera per kolumn'>Sortera</a></li>
<li><a href='movie_page.php' title='Dela upp resultatet på sidor'>Paginering</a></li>
<li><a href='movie_login.php' title='Logga in för att ändra i databasen'>Login</a></li>
<li><a href='movie_logout.php' title='Logga ut'>Logout</a></li>
<li><a href='movie_view_edit.php' title='Uppdatera info om film'>Uppdatera</a></li>
</ul>
<ul  class='nb-plain2'>
<li><a href='movie_create.php' title='Skapa ny film'>Skapa</a></li>
<li><a href='movie_view_delete.php' title='Radera film'>Radera</a></li>
<li><a href='movie_view.php' title='Kombinerat sökalternativ på en sida'>Visa komplett</a></li>
<li><a href='source.php' title='Se källkoden'>Källkod</a></li>
</ul>
</nav>
</div>		

    <div id='main'><h1>Sök film per år</h1>
<form>
<fieldset>
<legend>Sök</legend>
<p><label>Skapad mellan åren: 
    <input type='text' name='year1' value=''/>
    - 
    <input type='text' name='year2' value=''/>
  </label>
</p>
<p><input type='submit' name='submit' value='Sök'/></p>
<p><a href='?'>Visa alla</a></p>
</fieldset>
</form>
<p>Resultatet från SQL-frågan:</p>
<p><code>SELECT * FROM Movie;</code></p>
<p><pre></pre></p>
<table>
<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th></tr><tr><td>0</td><td>1</td><td><img width='80' height='40' src='img/movie/pulp-fiction.jpg' alt='Pulp fiction' /></td><td>Pulp fiction</td><td>1994</td></tr><tr><td>1</td><td>2</td><td><img width='80' height='40' src='img/movie/american-pie.jpg' alt='American Pie' /></td><td>American Pie</td><td>1999</td></tr><tr><td>2</td><td>3</td><td><img width='80' height='40' src='img/movie/pokemon.jpg' alt='Pokémon The Movie 2000' /></td><td>Pokémon The Movie 2000</td><td>1999</td></tr><tr><td>3</td><td>4</td><td><img width='80' height='40' src='img/movie/kopps.jpg' alt='Kopps' /></td><td>Kopps</td><td>2003</td></tr><tr><td>4</td><td>5</td><td><img width='80' height='40' src='img/movie/from-dusk-till-dawn.jpg' alt='From Dusk Till Dawn' /></td><td>From Dusk Till Dawn</td><td>1996</td></tr>
</table>
<footer class="byline">
  <figure class="right"><img src="img/me/me.jpg" alt="Börnen">
    <figcaption>En liten Björn.</figcaption>
  </figure>
  <p>Björn läser webbprogrammering vid Blekinge Tekniska Högskola. 
</p>

  <nav>
    <ul class="icons">
      <li><a href='https://plus.google.com/+bjornwiklund_privat/about'><img src='img/glyphicons/png/glyphicons_362_google+_alt.png' alt='google+-icon' title='Björn Viklund på Google+' width='24' height='24'/></a></li>
      <li><a href='http://se.linkedin.com/in/erikwi2000'><img src='img/glyphicons/png/glyphicons_377_linked_in.png' alt='linkedin-icon' title='Björn Viklund på LinkedIn' width='24' height='24'/></a></li>
      <li><a href='https://www.facebook.com/oldman24'><img src='img/glyphicons/png/glyphicons_390_facebook.png' alt='facebook-icon' title='Björn Viklund på Facebook' width='24' height='24'/></a></li>
      <li><a href='https://twitter.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_392_twitter.png' alt='twitter-icon' title='Björn Viklund på Twitter' width='24' height='24'/></a></li>
 <!--       <li><a href='http://mikaelroos.se/youtube'><img src='img/glyphicons/png/glyphicons_382_youtube.png' alt='youtube-icon' title='Björn Viklund på YouTube' width='24' height='24'/></a></li>
             <li><a href='http://mikaelroos.se/flickr'><img src='img/glyphicons/png/glyphicons_395_flickr.png' alt='flickr-icon' title='Björn Viklund på Flickr' width='24' height='24'/></a></li>
  -->
	<li><a href='http://instagram.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_412_instagram.png' alt='instagram-icon' title='Björn Viklund på Instagram' width='24' height='24'/></a></li>
	<li><a href='https://github.com/erikwi2000'><img src='img/glyphicons/png/glyphicons_381_github.png' alt='github-icon' title='Björn Viklund på GitHub' width='24' height='24'/></a></li>
    

		
		</ul>
  </nav>

</footer>
</div>

    <div id='footer'><footer><span class='sitefooter'>Copyright (c) Björn Viklund (bjvi13@student.bth.se) |
 Björn Wiklund (erikwi2000@gmail.com)  | 
 <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer></div>

      </div>



<script>
  var _gaq=[['_setAccount','UA-22093351-1'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>


</body>
</html>
