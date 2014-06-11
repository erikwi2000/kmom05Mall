<?php 
/**
 * This is a BWi pagecontroller.
 *
 */
// Include the essential config-file which also creates the $bwix variable with its defaults.
include(__DIR__.'/config.php'); 

//include(__DIR__ . '/theme/functions.php');
//echo __DIR__ . "--1<br>";

//global string $mepath;
//Me-path from redivisning x-cc
//include 'theme\functions.php';
//echo url() . "--2<br>";
$mepath = url() . '/../me.php';
//echo "<br> Mee-path" . $mepath;

//echo $_SERVER['HTTP_HOST'] . "--3<br>";
//echo $_SERVER['REQUEST_URI'] . "--4<br>";



// Do it and store it all in variables in the BWi container.
$bwix['title'] = "Redovisning";
// Fixa länkarna både statiska och dynamiska
$bwix['paths'] = '<p>me-sida:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom01/kmom01Mall/webroot/me.php">me-sidan</a>';
$bwix['paths'] .= '<p>bwix: <a href="http://www.student.bth.se/~bjvi13/oophp/kmom01/kmom01Mall/webroot/hello.php">bwix-sidan</a>' ;
$bwix['paths'] .= '<p>me-sida:<a href="' . $mepath . '">me-sidan</a>';
$bwix['paths'] .= '<p>bwix:<a href="' . $mepath . "/../hello.php" . '">bwix-sidan</a>';
$bwix['paths'] .= '<p>github: <a href="https://github.com/erikwi2000/kmom01Mall">github</a>';

// Fixa länkarna både statiska och dynamiska kmom02
$bwix['paths2'] = '<p>me-sida:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom02/kmom02Mall/webroot/me.php">me-sidan</a>';
$bwix['paths2'] .= '<p>bwix: <a href="http://www.student.bth.se/~bjvi13/oophp/kmom02/kmom02Mall/webroot/hello.php">bwix-sidan</a>' ;
$bwix['paths2'] .= '<p>me-sida:<a href="' . $mepath . '">me-sidan</a>';
$bwix['paths2'] .= '<p>bwix:<a href="' . $mepath . "/../hello.php" . '">bwix-sidan</a>';
$bwix['paths2'] .= '<p>github: <a href="https://github.com/erikwi2000/kmom02Mall">github</a>';

// Fixa länkarna både statiska och dynamiska kmom02
$bwix['paths3'] = '<p>me-sida:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom03/kmom03Mall/webroot/me.php">me-sidan</a>';
$bwix['paths3'] .= '<p>bwix: <a href="http://www.student.bth.se/~bjvi13/oophp/kmom03/kmom03Mall/webroot/hello.php">bwix-sidan</a>' ;
$bwix['paths3'] .= '<p>me-sida:<a href="' . $mepath . '">me-sidan</a>';
$bwix['paths3'] .= '<p>bwix:<a href="' . $mepath . "/../hello.php" . '">bwix-sidan</a>';
$bwix['paths3'] .= '<p>github: <a href="https://github.com/erikwi2000/kmom03Mall">github</a>';

$bwix['filepath01'] = '<ul>FILER<li><p><a href="' . $mepath . "/../../files/kmom03_bild.png" .'">ER-diagram</a></li>';
$bwix['filepath01'] .= '<li><p><a href="' . $mepath . "/../../files/ssql.sql" .'">SQL-kod</a></li>';
$bwix['filepath01'] .= '<li><p><a href="' . $mepath . "/../../files/modell.pdf" .'">ER-diagram</a></li></ul>';

// Fixa länkarna både statiska och dynamiska kmom02
$bwix['paths4'] = '<p>PFlimmer:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom04/kmom04Mall/webroot/pflimmer.php">Film-sidan</a>';
$bwix['paths4'] .= '<p>me-sida:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom04/kmom04Mall/webroot/me.php">me-sidan</a>';
$bwix['paths4'] .= '<p>bwix: <a href="http://www.student.bth.se/~bjvi13/oophp/kmom04/kmom04Mall/webroot/hello.php">bwix-sidan</a>' ;
$bwix['paths4'] .= '<p>me-sida:<a href="' . $mepath . '">me-sidan</a>';
$bwix['paths4'] .= '<p>bwix:<a href="' . $mepath . "/../hello.php" . '">bwix-sidan</a>';
$bwix['paths4'] .= '<p>github: <a href="https://github.com/erikwi2000/kmom04Mall">github</a>';

// Fixa länkarna både statiska och dynamiska kmom02
$bwix['paths5'] = '<p>PFlimmer:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom05/kmom05Mall/webroot/blogg.php">blogg-sidan</a>';
$bwix['paths5'] .= '<p>me-sida:<a href="http://www.student.bth.se/~bjvi13/oophp/kmom05/kmom05Mall/webroot/me.php">me-sidan</a>';
$bwix['paths5'] .= '<p>bwix: <a href="http://www.student.bth.se/~bjvi13/oophp/kmom05/kmom05Mall/webroot/hello.php">bwix-sidan</a>' ;
$bwix['paths5'] .= '<p>me-sida:<a href="' . $mepath . '">me-sidan</a>';
$bwix['paths5'] .= '<p>bwix:<a href="' . $mepath . "/../hello.php" . '">bwix-sidan</a>';
$bwix['paths5'] .= '<p>github: <a href="https://github.com/erikwi2000/kmom05Mall">github</a>';



$bwix['main'] = <<<EOD
<article class="readable">

<h1>Redovisning av kursmomenten</h1>



<h2>Kmom01: Kom igång med Objektorienterad PHP</h2>

<p> Miljö.
<p> Har: Latitude E5530, Windows 7 Pro. HW Intel Core i7-3540 M CPU @ 3GHz. 
Minne 16GB RAM (nice!), 128GB SSD samt 3TB USB3 disk.

<p>Använder Chrome (mest), Firefox, Opera, Safari (lite bara)
 och ibland Internet Explorer (inte ofta)
 Dessutom kämpar jag med att lagra filer/bilder etc. på Google drive....raw verkar inte fungera, säger dom..

<p>Använder de rekommenderade verktygen (FileZilla/jEdit)
 (filer: sftp://sftp.student.bth.se). Har Notepad och nyligen Adobe-verktyg.
XAMPP används.
<p>Kursmomentet.
<p> "Beginning PHP and MySQL: From Novice to Professional" riktigt bra kapitel dessa 5 första. Bör läsas i ett svep också.
<p> Guiden riktigt bra! Saknade en sådan här sammanställning i htmlphp-kursen.Även om allt inte sitter
 efter den första genomgången så känns strukturen och uppdelningen 
 riktigt berikande även om jag har lite sedan förra kursen med mig.
 <p>Anax himla bra med en "färdig" struktur då slipper man en del "trial and error" under resans gång. 
 Generellt är det himla bra att ha lite historik. Har tagit mig igenom git och github känns proffsigt!
 <p>Dynamisk meny där blev det lite dimmigt trots att jag pysslade lite med det i förra kursen. 
 Bra med exemplet array av array.
 <p> source.php riktigt berikande så bekvämt jämfört med andra verktyg
 
 <p> Anax blev bwix.
 <p> Me-sidan betydligt enklare denna gång än förra. Lite trickigt med slideshow ha tålamod så börjar det 
 byta bild.
 <p> Håll reda på .JPG och .jpg!
 <p>jEdit + FileZilla == BRA!
{$bwix['paths']}




<h2>Kmom02: Objektorienterad programmering i PHP</h2>

<p>En jobbig resa. Tuffast hittils tror att vartefter vi rapporterar 
    svårigheter så kommer ni att justera vartefter. Jag råkade ut för en "konstig sak":
     använde både Notepad och NetBeans samtidigt och projekten fungerade perfekt 
         och validerade förutom lite strul med "buttons".
Sagt och gjort fixade och plötsligen så dog sessionen vid varje inmatning, uppenbarligen
så hade jag på något sätt plockat bort en rad eller så så att det 
fungerade inte.
Sylvanas var en mycket hjälpsam "chattare". Stort TACK Jane!
     Hoppas en del "findings" är väl tatuerade i minnet.</p>
<p> Men NetBeans och www.websequencediagrams.com RIKTIGT NICE 
liksom knappgeneratorer. Det  finns så mycket där ute så en liten del vore nog.</p>
<p> Ett litet nytt mindset behövs för mig för att ta mig an detta. 
Själva upplägget med en bastant 
plattform där man hela tiden ser 
till att åtminstone alla tidigare gjorda saker fungerar  bra.
<br>Lite nytt hittar man på, lägger till osv. så efter en resa så finns mer i "skelettet" än som skapades från början.
<p> Tyvärr så har jag ägnat mycket tid åt en sak som jag gjort förut och som fanns dvs
att visa tärningen på sidan efter att jag slagit. (../img/... etc.)<br>
<br>Det som inte fungerade var kopplingen till foldrarna för bilden....och
detta har jag ju gjort flera gänger MEN ded tog tid...denna gången också.
<p> Som förut så är 20 stationer riktigt bra, för de flesta avsnitten, 
DOCK saknar jag här precis som i första kursen ett skelett med de "vital few" som man kan luta sig mot då
det "strular". <br>Böckerna är bra MEN ack så kompletta så här i början. 
Det skulle inte sitta fel med en översikt MEN tror dock att den finns där ute det är oftast bara att "surfa på"
trodde inte det fanns så mycket programvara och dessutom talar jag om fria program.
<p>Borde det inte kunna vara ett, eller flera, exjobb som skapar en sökbar kunskapsbank
anpassad/lämplig till de kurser ni kör? 
<p>Många gånger ser jag inte skogen bara för en massa träd dessutom så har jag svårt för semantiken eftersom jag har ett annat språk då jag tolkar kod¨
dvs ibland ser exemplen ut som ett helt främmande språk....dock bit för bit ungefär som programkoden så 
drar jag mig lite framåt i varje avsnitt.
<p>Litemer. git fungerar riktigt nice, jag printade MOS text till föredraget och det fungerar riktigt
    fint....dock kanske jag inte lägger upp förrän 
koden validerat "där uppe". 
<p> Har flyttat det mesta från page-controller till klasser/funktioner en tuff och rörig resa MEN till nästa gång så blir det bättre.


{$bwix['paths2']} 
<h2>Kmom03: SQL och databasen MySQL</h2>


<h3>Har gått igenom de olika momenten:</h3>

<ol>
<li>Kom igång med databasen MySQL och dess klienter</li>
<li>BTH's labbmiljö för databasen MySQL</li>
<li>Kom igång med SQL</li>

</ol>

<p>Har bara hört talas om databaser aldrig använt eller blivit bekant med principen. 
<br>Jaa förutom då det jag gjorde i förra kursen htmlphp där vi använde SQLite ihop med php. 
<p>Sedan har jag ju hört och sett en mängd "buzz" om databaser och relationsdatabaser därför är det ganska roligt att se att det:
<ul>
<li>dels är något annat än jag föreställde mig</li>
<li>dels är logiskt MEN kräver för mer avancerade uppgifter ganska god insikt i manualen.</li>
</ul>
<p>BTH's labbmiljö för databasen MySQL är ganska mångfacetterad, minst sagt. 
<p>Tre verktyg lokalt och tre verktyg på server. 
<br>Som "vanligt" så är det kommandostyrda verktygen oftast bra för detaljer medan de mer "avancerade" ger en bättre överblick.
<br>Lokal exekvering är för mig mer kontrollerbar och är lättare att "komma åt". 
<p>Jag har svårare att se vad som händer på serversidan på BTH.
<h4>Har använt de olika verktygen:</h4>
<ul>
<li>MtSQL Workbench är riktigt nice, ger ibland till och med begripliga tips för rättning av fel,</li>
<li>PHPMyAdmin har jag kört men inte använt så mycket.</li>
<li>Kört Command line också men inte så mycket.</li>
</ul>
<p>Har mest kört lokalt, det var vissa begränsningar såväl som viss instabilitet i uppkopplingen just för PuTTY.
PuTTY stängs av intermittent eventuellt kopplat till inaktivitet..
<p>Lösenordshanteringen till MySQL på servern känns lite "klumpig". 
<p>Jag hittade i alla fall inget sätt att skapa mitt egna lösenord (ändring från det genererade alltså)
utan sparade det email som jag fått som kvittens. 
Gick sedan tillbaka till detta för passord till inloggning. 
<br>Nu var det dessutom lite problem med  av anslutningarna tog detta i forumet:
<br><a href="http://dbwebb.se/forum/viewtopic.php?f=37&t=2161&p=18393#p18393"> Här är tråden</a>
<p>SQL-övningen moment 3 var riktigt rolig. 
Det blev svårare på slutet men mycket information fanns ju med i kompendiet.
Mycket information, men logiskt, blir dock komplicerat i slutat av kursmomentet. 
<br>MEN det ser väldigt kraftfullt ut tack vara att verktyget "plockar fram" 
alla kopplingar mellan olika data på ett konsistent sätt. 
<br>Att spara olika MySQL kodbitar verkar ett riktigt bra tips. 
<br>Jag antar att när man gör databaser "på riktigt" så lagrar man MySQL koden för databasen för backup etc.
<p>Momentet som helhet fungerar bra. <br>Just de olika uppkopplingarna kan dock gärna vara mer precisa i beskrivningarna samt seamless så att inte tid ägnas åt "onödiga" saker. 

<br>PS: Har minskat kod i pagecontroller ännu mer. DS




{$bwix['filepath01']} 


{$bwix['paths3']} 

<h2>Kmom04: PHP PDO och MySQL</h2>

<p>Jaa ett väldigt intressant och lärande avsnitt. <p>Kanske aningen "pilligt" i vissa delar 
    då både oophp och MySQL skall exekveras dock gick det ganska bra på den tid som var förespeglad 
15-22 timmar egentligen inga stora problem. 
    <p>Nja nu kanske jag tar i lite granna.
<br>Tidsåtgången stämmer vad gäller redovisning såväl som allt annat som jag förberett för
"ifyllnad" vartefter men det övriga?
<p>Jaa även läsanvisningar fungerade väl, allt läst och en del förstått. 
    <br>Men uppgifterna osv
<h3><b>speciellt uppmaningen att "göra själv". </b></h3>
    <p>Valde en lösning "CFilmhandle" med fick en liten bit kvar <br>som
        mest landade jag på 2000 rader!
<p>Då gav jag upp och tittade mer i "fusklappen" och gjorde på det
    sättet i stället, mycket enklare. Nåväl jag kanske inte har gjort
det som skulle göras o/e på rätt sätt heller.
<p>  Sedan gjorde jag några med "magra" sidkontroller efter ett tag. 
<p> Fortfarande blir "blocken"av vilket slag det vara månde "stora"passerar lätt 100 rader.
<br> Lite kan man spara genom att ta bort alla typer av kommentarer, gammal kod osv.
<p> SESSIONER tog lång tid innan jag började få tag i det.
<br> Surfade där ute och hittade en sida..läste en halv A4 och förstod mer än under det senaste året.
<p> PDO också trickigt att förstå. Har nog inte stenkoll på något men
det blir bättre vartefter.
<p> Hittar info i forum och i chat MEN varför inte "lägga ut" sådant up front?
    <p>Jag önskar att det fanns ett tydligare top-down  bottom-up 
förfarnade som visas så att man får de stora dragen klara för sig 
    och sedan kan man lägga detaljer senare.
<br>Sedan är dessutom inloggningar och dylikt lite trickiga också. 
    <br>Där det förutom allta annat finns 
olika servrar WAMP, XAMPP och kanske någon mer ihop med Unix/Windows. 
    <br>Sedan olika MySQL verktyg (3?) lokala och på server...mycket
att tänka på. <p>Vore bra att slippa pilla för mycket med sådant.
Men en sak ska sägas: <h4>Man lär sig himla mycket</h4> men det tar alldeles för mycket
    tid i förhållande till de 20 timmar ni sagt.
<p>Har man förkunskaper visst men om man inte har, ej krav, då blir det svårt att klara 
    varje moment på en halv arbetsvecka.
<ul>
    ¨<li>www.websequencediagrams.com så nice speciellt napkin</li>
<li>NetBeans</li>
<li>http://www.picresize.com/</li>
<li>m.fl.</>
</ul>




{$bwix['paths4']} 
<h2>Kmom05: ...</h2>
<h2> Intensivt</h2>
<p>Jaa trots mycket använd tid  så blev jag inte klar i tid..
    <br> Upplever kursupplägg såväl som kursmaterial väldigt bra 
        och komplett och fullständigt.
        <p> MEN jag hittar inte vägen till den minskade entropin. 
            Detaljrikedomen är helt överväldigande.
            <br> Dessutom så finns inte så mycket grad och art
   på innehållet. Jag skulle uppskatta en struktur för kursen, 
   kursmomenten.<br> Jag ser inte skogen för alla träd och skulle behöva én guide.
       <br> Jag gjorde samma misstag som förut här...
           satte igång med menyerna för att skapa dubbla, "pull-down". 
  Såg hur andra hade gjort och det såg väldigt snyggt och 
      innovativt ut. 
          Tyvärr så "kom jag inte på hur göra" så jag 
 löste det på ett "jätteklumpigt" sätt, finns kvar i kmom04.
           <br> Kollade ännu mer på att många andra
  hade gjort som jag ville det skulle bli 
      MEN det blev inte så, annat än från utsidan...
  
   <p>Och sedan som en händelse så hittade jag de fyra navbar-instruktionerna från coachen.<br>
       <br>Mångas lösningar påminde om det som coachen visade.
     <br> På några timmar implementerade jag detta i stället för min "klumpiga" lösning.
      <br> Tror inte jag är ensam om att tycka att
       det är svårt att hitta just de guldkornen man behöver "just nu" 
       <br> dvs man letar länge.
        <br> Annat exempel: SESSIONS var länge lite
         av magi.Kanske fortfarande lite så men inte alls 
          lika "oförståeligt".<br>
         Jag surfade, Google, första "draget" någon av de
          första träffarna klickade läste ungefär en
        halv A4-sida och plötsligen så insåg
         jag mer än under hela kurserna rörande SESSIONS.
         <br> Jag läset att någon/några mer 
             hade haft likande svårigheter.
             <br>Jag hittar ingen sökmotor på dbwebb,som söker i innehållet på dbwebb,
    men som så mycket annat kan jag ha missat även detta, 
        vilket skulle vara berikande att "träffa direkt".
    <p>Jag är vid "dead line" halvvägs in i uppgift 5 
        och som sades har precis gjort om navbar efter
        senaste rön.
            <p>MEN KURSEN ÄR RIKTIGT BRA INNEHÅLLSMÄSSIGT. MED LITE STRUKTUROCH 
                LIKNANDE SÅ KAN DETTA BLI "BEST IN CLASS". 
                    JAG GNÄLLER INTE AV MISSNÖJE I SÅDANT FALL HADE JAG LÄMNAT DETTA UTAN 
            FASTMER SÅ FÖRSÖKER JAG FRÅN MIN UPPLEVELSE GE TIPS SOM SKULLE HA HJÄLPT MIG.
      SÅ KRITIKEN ÄR HELT KONSTRUKTIVT MENAD OCH FÖRBÄTTRINGSPOTENTIALEN ÄR MYCKET GOD.</p>

{$bwix['paths5']} 
<h2></h2>


<p>Redovisningstext...</p>


<h2>Kmom07/10: ...</h2>

<p>Redovisningstext...</p>


{$bwix['byline']}



EOD;



// Finally, leave it all to the rendering phase of BWi.
include(BWI_THEME_PATH);
