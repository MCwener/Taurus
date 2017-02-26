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
        echo  "<img src='img/cards/cards/$suit/$num.png'/>";   
        //echo "<img src='img/cards/$suit/$num.png'/>"; //This is my directory so my program can run (Fernando)
    }
}
function getScore($player){
    global $playerSum;
     
    $winners = getWinnerIndex();
    if(in_array($player, $winners)){
        echo "<font color = 'red' size = '5' > Winner!!!:  ".$playerSum[$player]. " has won ". getPointsWon(). " points! </font>";
        
        
        
    } else {
        echo "<font color = '#f2f2f2' size = '3'> Score: ".$playerSum[$player]. " You loose!</font>" ;
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
    //echo "<img id = players src='img/Players/" . $Players[$index] . ".jpg' border = '4'/>"; //(Fernando's Directory)
    echo "<img id = players src='/Taurus/img/Players/" . $Players[$index] . ".jpg' border = '4'/>";
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Silverjack </title>
    <style>
        body {
            background-image: url("/Taurus/img/Table.svg");
            /*background-image: url("img/Table.svg"); (Fernando's Directory)*/ 
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
        #rematchButton, button{
            float: right;
            font-size:20px;
            color:black;
            background-color:#c5b358;
            position:absolute;
            bottom:300px;
            padding:30px;
            margin: 0 500px 500px 0;
            left: 900px;
            right: 1300px;
            top: 400px;
        }
        #Player1{
            float: left;
            position:absolute;
            margin:100px 100px 510px 300px;
            bottom:3px;
            font-size:30px;
            background-color:#c0c0c0;
            color:#ffd700;
        }
        #Player2{
            float: left;
            position:absolute;
            margin:340px 0 0 500px;
            font-size:30px;
            background-color:#c0c0c0;
            color:#ffd700;
        }
        #Player3{
            float:right;
            position:absolute;
            margin: 340px 0 0 1050px;
            font-size:30px;
            background-color:#c0c0c0;
            color:#ffd700;
            
        }
        #Player4{
            float:right;
            position:absolute;
            margin:100px 0 0 1390px;
            font-size:30px;
            background-color:#c0c0c0;
            color:#ffd700;
        }
       h3 {
            color: #ffff1a;
        }
        #score1, #score2, #score3, #score4 {
            color: #f2f2f2;
        }
        
    </style>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    
    <body>
        
        <!--<img id= "TLogo" src = "img/Logo/Logo.png" alt = "Logo" />  Fernando's Directory -->
        <img id= "TLogo" src = "/Taurus/img/Logo/Logo.png" alt = "Logo" /> 
        <div id= "outside">
        <h3 id = "1"><u>Player 1</u></h3>
        <div id = "first"><?=getHand(0)?></div>
        <div id = "score1"><?=getScore(0)?></div>
        <p id = "Player1"> Player 1 </p>
        
        <h3 id = "2"><u>Player 2</u></h3>
        <div id = "second"><?=getHand(1)?></div>
        <div id = "score2"><?=getScore(1)?></div>
        <p id = "Player2"> Player 2</p>
        
        <h3 id = "3"><u>Player 3</u></h3>
        <div id = "third"><?=getHand(2)?></div>
        <div id = "score3"><?=getScore(2)?></div>
        <p id = "Player3"> Player 3</p>
        
        <h3 id = "4"><u>Player 4</u></h3>
        <div id = "forth"><?=getHand(3)?></div>
        <div id = "score4"><?=getScore(3)?></div>
        <p id = "Player4"> Player 4</p>
        
        </div>
        
        <div id ="Button">
            <button onclick="replayGame()" id = "rematchButton">Rematch!</button>
            <script>
                function replayGame() {
                location.reload();
            }
            </script>
        </div>
        
    </body>
</html>