<?php
/**
 * A class for dumping, with graphical representation, to roll.
 *
 */
class CDump {

private $secret;
public $roll;
public $noll;
public $init;
public $hello;
public $test;
public $engang = "gång.";
public $flergang = "gånger.";


  public function __construct() {
 $this->secret = "";
 }
 
 
 


 
  public function GetNollResult () {
         $engang = "gång.";
$flergang = "gånger.";

		$resultString = ""; 
		$statString = ""; 
		$saveString = "";
      if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}
      
      
     {
    

		$highScore = $hand->GetHighScore();
		$totall = $hand->GetRoundTotal(); 
		$hand->CleanSumRound();
		$temp = $hand->GetSumRound();
		$statStringNoll = "<h3>Din summa har nollats och adderats till Sparad score! </h3> "; 		
		$ppppp = $hand->GetRoundsOK();	
		if($ppppp == 1) {
			$statStringNoll .= "<h4>Du har kastat tärningen: $ppppp $engang </h4>"; 
		}
		else {
			$statStringNoll .= "<h4>Du har kastat tärningen: $ppppp $flergang </h4>"; 
		}
                if($hand->noRolls){}
		$statStringNoll .= "<h3>Sparad score: $highScore</h3>"; 
		$hand->CleanSumRound();
               // echo "kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
return $statStringNoll;
}
  }
  
 
 
 

 
 
public function GetHello() {
 $hello = "Hello world";
 return $hello;
 }
 
 public function GetInputInfo() {
     $statStringRoll = "EMPTY";
     $choice = "destruct";
 $roll = isset($_GET['roll']) ? true : false;
 if($roll){$choice = "roll"; 
//$dump->GetRollResult();
 }
$init = isset($_GET['init']) ? true : false;
 if($init){$choice = "init";
 
 }
$noll = isset($_GET['noll']) ? true : false; 
 if($noll){$choice = "noll";
 
 }
//echo "<br> choice" . $choice;
 
     
 
 

return $choice;

 }
 
 
 public function GetRollResult () {
     
     if(isset($_SESSION['dicehand'])) {
  $hand = $_SESSION['dicehand'];
}
else {
	$hand = new CDiceHand(1);
  $_SESSION['dicehand'] = $hand;
}

//-------

//--------------------
// $roll = TRUE;
 //$out = FALSE;
 $engang = "gång.";
 $flergang = "gånger.";
 $statStringRoll = "<br>";
// $statStringRollGo = "-----";
//  $statStringRollW = "";
 //   $statStringRollL = "";
    		$totall = $hand->GetRoundTotal(); 
       //         $noMore = FALSE;
 //if(!$hand->winnerTakesAll){
 //echo "ddddd " . $hand->winner;
 
      
 //---------------------------

if (!$hand->noRolls) { 
                 if ($hand->GetRolls() == 1)
                     // ETTA
                        { 
                     // xxxxx  echo "<br> Round total 1" . $hand->GetRoundTotal();
                            $statStringRoll .= "<h2>Tyvärr!</h2> Du slog en " . 
                            $hand->GetRolls(). "'a och dina OSPARADE poäng har nollställs!!!<br>"; 
                            $hand->CleanSumRound(); 				
                            $hand->SetRoundTotal() ; 
                            		$tot = $hand->GetSumRound();
                                        $statStringRoll .= "<h3> Din runda: $tot </h3>";		
                                        $totall = $hand->GetRoundTotal(); 
                                        if($totall > 3){
                                        $statStringRoll .= "<h3>  Din summa : $totall  kvar</h3><br>"; 
                                        $hand->SetRoundTotal() ;           
                                        
                                        }
                                        else {
                                        $statStringRoll .= "<h3>  Tyvärr din summa : $totall  \"lite\" kvar</h3><br>"; 
                   
                                }                           
                        }
                          // Slut ETTA
                        else
                             //Före EJ ETTA
                       {
                   if($hand->GetRoundTotal()  > 100)
                            {
      // xxxxx  echo "<br> Round total 2" . $hand->GetRoundTotal();
  
                            $totall = $hand->GetRoundTotal();
                                      // xxxxx  echo  "<br>mm 5inside! $totall"; 
                            // xxxxx  echo "<br> > 100";
                       		$statStringRoll .= "<h3>Din runda är INTE:"; 
                                $statStringRoll .= "<br> $totall är 'OutOfBounds' försök med nytt spel!</h3>";
                                $hand->noRolls = TRUE;
                             return $statStringRoll;   
                        }

                        if($hand->GetRoundTotal()  == 100)
             // Kolla               
                        {
                       $statStringRoll .= "<h2>Grattis! Du har uppnått 100 poäng!!!";        
                               { 
                                               // xxxxx  echo  "<br>mm 3inside!"; 
                               $hand->setHighScore(); 
                               $statStringRoll .= 
                               "<br>Du är hemma till 100!</h3>"; 
                               $hand->winner = TRUE; 
                               $hand->noRolls = TRUE;
                                return $statStringRoll; 
                           //    $this->winner2 = TRUE;
                               } 
                                           // xxxxx  echo  "<br>mm 4inside! <br> $statStringRoll"; 
                                           
                        }
                          if($hand->GetRoundTotal()  < 100
                                  
                                  
                                  
                                
                                  
                                  
                                  
                                  )
                                {
                            		$tot = $hand->GetSumRound();
                                
		$statStringRoll .= "<h3>Din runda: $tot";		
		$totall = $hand->GetRoundTotal(); 
		$statStringRoll .= " Din summa totalt: $totall</h3> "; 
                           // xxxxx  echo "<br> < 100";
                                $ppppp = $hand->GetRoundsOK();	
                                if($ppppp == 1) 
                                    {
                                         $statStringRoll .= "<h3>Du har kastat tärningen: $ppppp $engang "; 
                                }
                                else 
                                    {
                                         $statStringRoll .= "<h3> Du har kastat tärningen: $ppppp $flergang "; 
                                    }
                                    	$highScore = $hand->GetHighScore();
                                        $statStringRoll .= " Sparad score: $highScore</h3>"; 
                        }
                        }
                 //    $statStringRoll .= "jjjjjjjjjjjjjjjjj"; 
                }
 //Efter EJ ETTA
 //----------------------------------

	if($hand->noRolls) 
    {$statStringRoll = "<h2> Game Over! <br> No more rolls!</h2>"
        . "<h3> Start new game or destroy  Session </h3>" ;
	if($hand->GetHighScore() == 100){ 
            $statStringRoll .= " Your WINNER Score: " . $hand->GetHighScore() . " Be HAPPY!</h3>";  
        }
     return $statStringRoll;
     }
                         if(($totall) < 100){
                     //      $statStringRoll .= "hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh"; 
                         return $statStringRoll;   
                         }

                         
   $statStringRoll = "<h1>HJÄLP!</h1> <br> Tänk rät!"
           . "<br>Gör Rätt"
           . "<br> starta om!";                      
                           return $statStringRoll;
                    
                           
                         if(($totall == 100) ){
                             
                         $statStringRoll = "<h2>Fortfarande vinnare</h2>"
                                 . "<br> <h3>Starta spel eller förstör session</h3>";
                   
                           
      //1-100  
                         $hand->winner = TRUE; 
                        $hand->noRolls = TRUE; 
                        return $statStringRoll;
                                                    }
                        
                         

     
     
     
} 
  

 

 public function GetAddPart1() {
     
   
   $transport =<<<EOD

<article class="readable">
        
           
           
           
<h2>Spela tärning till 100</h2>
<p> Spelet är att summera alla slag och försöka nå till 
100, vägen kan sparas i steg vartefter. DOCK
inte över 100. Man får avsluta när man själv vill.
Sedan är det också önskvärt är att nå 
fram på så få slag som möjligt.

<br>



<div class="span-1">
    <span>Reglerna för summering är:</span>
    <ul>
				<li> 2-6 addera till din total.
				<li> 1 då, tyvärr, så landar din total på 0 igen
    </ul>
</div>


  <div style="margin:5px;">      
<a  href="?init" class="LinkButton">   Starta spelet. </a>    
<a href="?roll" class="LinkButton">   Kasta tärningen.</a>
<a   href="?noll" class="LinkButton">   Spara&amp;Nolla.</a>
<a  href="?destroy" class="LinkButton">   Förstör session.   </a>  
                  
</div>

			
			

EOD;
    return $transport; 
     
 }

 
}
