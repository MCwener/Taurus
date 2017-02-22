<?php

//Spades = 0-12 
//Hearts = 13-25
//Clubs = 26-38
//Diamonds = 39-51

$deck = array();
$Player1 = array();
$Player2 = array();
$Player3 = array();
$Player4 = array();
$playerHand = array($Player1, $Player2, $Player3, $Player4);
$playerSum = array(0, 0, 0, 0);

for($i=0; $i < 52; $i++){
    $deck[] = $i;
}

array_pop($deck);
shuffle($deck);

for($i=0; $i < 4; $i++){
    while($playerSum[$i] <= 36){
        $val = array_pop($deck);
        $playerSum[$i] += $val%13;
        array_push($playerHand[$i], $val);
    }
}

print_r($playerSum);

function displayRandomImage(){
    global $deck;
    $suitArray = array("clubs", "diamonds", "hearts", "spades");
    $index = rand(0,3);
    $randomSuit = $suitArray[$index];
    echo  "<img src='img/cards/cards/$randomSuit/".rand(1,13).".png'/>";
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Arrays Review </title>
    </head>
    <body>

      <img src="img/cards/cards/clubs/<?=rand(1,13)?>.png" />
      
      <?=displayRandomImage()?>
      
    </body>
</html>