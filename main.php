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


function generateGame(){
    global $playerHand;
    global $suitArray;
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
}    
    
function getHand($player){
    global $playerHand;
    global $suitArray;
    $hand = $playerHand[$player];
    for($j=0;$j<count($hand); $j++){
        $suitIndex = floor($hand[$j]/13);
        $suit = $suitArray[$suitIndex];
        $num = ($hand[$j]%13)+1;
        echo  "<img src='../img/cards/cards/$suit/$num.png'/>";
    }
}

function getScore($player){
    global $playerSum;
    $winners = getWinnerIndex();
    if(in_array($player, $winners)){
        echo "Winner: ".$playerSum[$player]. " has won ". getPointsWon(). " points!";
    } else {
        echo "Score: ".$playerSum[$player];
    }
}

//will return -1 if everybody went over 42
function getWinnerIndex(){
    global $playerSum;
    $winner = array(-1);
    for($i=0; $i<count($playerSum); $i++){
        //new single highest value
        if($playerSum[$i] < 43 && $playerSum[$i] > $playerSum[$winner[0]]){
            //reset array
            if(count($winner) > 1){
                unset($winner);
                $winner = array($i);
            } else {
                //set single value in array to winner index
                $winner[0] = $i;
            }
            //multiple winners
        } else if($playerSum[$i] == $playerSum[$winner[0]]){
            array_push($winner, $i);
        }
    }
    return $winner;
}

function getPointsWon(){
    global $playerSum;
    $total = 0;
    $winner = getWinnerIndex();
    if(count($winner) > 1){
        return (array_sum($playerSum)-($playerSum[$winner[0]]*count($winner)));
    } else {
        return (array_sum($playerSum)-$playerSum[$winner[0]]);
    }
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Arrays Review </title>
    </head>
    <body>
      
      <?=getHand(0)?>
      <?=getScore(0)?>
      <br/>
      <?=getHand(1)?>
      <?=getScore(1)?>
      <br/>
      <?=getHand(2)?>
      <?=getScore(2)?>
      <br/>
      <?=getHand(3)?>
      <?=getScore(3)?>
      
    </body>
</html>