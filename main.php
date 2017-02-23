<?php

$deck = array();
$Player1 = array();
$Player2 = array();
$Player3 = array();
$Player4 = array();
$playerHand = array($Player1, $Player2, $Player3, $Player4);
$suitArray = array("spades", "hearts", "clubs", "diamonds");
$playerSum = array(0, 0, 0, 0);

for($i=0; $i < 52; $i++){
    $deck[] = $i;
}

shuffle($deck);

for($i=0; $i < 4; $i++){
    while($playerSum[$i] <= 36){
        $val = array_pop($deck);
        $playerSum[$i] += ($val%13)+1;
        array_push($playerHand[$i], $val);
    }
}
function getHand(){
    $hand = array_pop($playerHand);
    for($j=0;$j<count($hand); $j++){
        $suitIndex = floor($hand[$j]/13);
        $suit = $suitArray[$suitIndex];
        $num = ($hand[$j]%13)+1;
        echo  "<img src='../img/cards/cards/$suit/$num.png'/>";
    }
}
for($i=0; $i<5; $i++){
    $hand = array_pop($playerHand);
    for($j=0;$j<count($hand); $j++){
        $suitIndex = floor($hand[$j]/13);
        $suit = $suitArray[$suitIndex];
        $num = ($hand[$j]%13)+1;
        echo  "<img src='../img/cards/cards/$suit/$num.png'/>";
    }
    echo "<br/>";
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Arrays Review </title>
    </head>
    <body>
      
      
      
    </body>
</html>