<?php

$deck = array();
$Player1 = array();
$Player2 = array();
$Player3 = array();
$Player4 = array();
$playerHand = array($Player1, $Player2, $Player3, $Player4);
$suitArray = array("spades", "hearts", "clubs", "diamonds");
$Players = array("Daniel", "Antoni", "Phil", "Phil H."); //Array of players
$playerSum = array(0, 0, 0, 0);


shuffle($Players); //We need the players to be "Random"

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
            //echo  "<img src='/Taurus/img/cards/$suit/$num.png'/>"; //Sorry my c9 is weird with pictures
            echo  "<img src='../img/cards/cards/$suit/$num.png'/>";
        }
        echo "<br/>";
    }
}    
    
function getHand($player){
    global $playerHand;
    global $suitArray;
    $hand = $playerHand[$player];
    PrintPlayer($player);
    for($j=0;$j<count($hand); $j++){
        $suitIndex = floor($hand[$j]/13);
        $suit = $suitArray[$suitIndex];
        $num = ($hand[$j]%13)+1;
        //echo  "<img src='/Taurus/img/cards/$suit/$num.png'/>";  //Sorry my C9 is weird with pictures
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
//Simple function to display players
function PrintPlayer($index){   
    global $Players;
    echo "<img id = players src='/Taurus/img/Players/" . $Players[$index] . ".jpg'/>";
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Arrays Review </title>
    <style>
        body {
            background-color:#54cc49;
        }
        #outside {
            text-align:left;
        }
        #first, #second, #third, #forth {
            text-align:center;
            right: 0px;
            width: 700px;
            padding: 9px;
            width:1000px;
        }
        #players {
            padding: 9px;
        }
        h1 {
            text-align: center;
        }

    </style>
    </head>
    <body>
        <h1>SilverJack</h1>
        <div id= "outside">
        <div id = "first"><?=getHand(0)?>
        <?=getScore(0)?></div>
        
        <div id = "second"><?=getHand(1)?>
        <?=getScore(1)?></div>

        <div id = "third"><?=getHand(2)?>
        <?=getScore(2)?></div>
        
        <div id = "forth"><?=getHand(3)?>
        <?=getScore(3)?></div>
        </div>
    </body>
</html>