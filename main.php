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
        <title> Silverjack </title>
    <style>
        body {
            background-image: url("/Taurus/img/Table.svg");
            background-color:#54cc49;
            background-size: 1920px 1300px;
            background-repeat: no-repeat;
        }
        #outside {    
            margin-left: 20px;
            margin-right: 50%;
        }
        #second, #third, #forth {
            text-align:left;
            right: 0px;
            width: 700px;
            padding: 9px;
            width:1000px;
        }
        #players {
            padding: 9px;
        }
        h1 {
            text-align:center;
        }
        #TLogo {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 60px;
            margin-right: 10px;
            margin-top: 10px;
        }
        #first {
            transform: rotate(30deg);
            float: right;
            margin: 0 0 10px 10px;
            width: 700px;
            padding: 9px;
            width: 300px;
            position: absolute;
            left: 200px;
            right: 1450px;
            top: 400px;
            bottom: 900px;
            
        }
        #second {
            transform: rotate(15deg);
            float: right;
            margin: 0 0 10px 10px;
            width: 700px;
            padding: 9px;
            width: 400px;
            position: absolute;
            left: 500px;
            right: 1100px;
            top: 600px;
            bottom: 850px;
        }
        #third {
            transform: rotate(-15deg);
            float: right;
            margin: 0 0 10px 10px;
            width: 700px;
            padding: 9px;
            width: 400px;
            position: absolute;
            left: 1000px;
            right: 800px;
            top: 600px;
            bottom: 800px;
        }
        #forth {
            transform: rotate(-30deg);
            float: right;
            margin: 0 0 10px 10px;
            width: 700px;
            padding: 9px;
            width: 300px;
            position: absolute;
            left: 1450px;
            right: 200px;
            top: 400px;
            bottom: 900px;
        }
    </style>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    
    <body>
        
        <img id= "TLogo" src = "/Taurus/img/Logo/Logo.png" alt = "Logo" />
        <div id= "outside">
        <div id = "first"><?=getHand(0)?></div>
        <div id = "score1"><?=getScore(0)?></div>
        
        <div id = "second"><?=getHand(1)?></div>
        <div id = "score2"><?=getScore(1)?></div>

        <div id = "third"><?=getHand(2)?></div>
        <div id = "score3"><?=getScore(2)?></div>
        
        <div id = "forth"><?=getHand(3)?></div>
        <div id = "score4"><?=getScore(3)?></div>
        </div>
    </body>
</html>