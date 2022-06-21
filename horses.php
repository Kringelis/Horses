<?php


/* hipodroms, laukums
dalibnieki - @, *, ^ - random 1,3 laucini
------------------------------
------------------------------
------------------------------

sleep 1;
kad visi galaa, tabula echo 1st 2nd 3rd
BET
ja ir divi reizee tad 1st 1st, 2nd 2nd,
*/


$length = 20;
$horses = explode(' ', readline('horses here:'));
$track = [];
$bet = (int)readline('place your bet: ');
$better = readline('choose your fighter: ');


for ($i = 0; $i < count($horses); $i++) {
    $track[$i] = array_fill(0, $length, '-');
    $track[$i][0] = $horses[$i];
}
$finished = [];
$go = 0;
while (count($finished) < count($horses)) {
    system('clear');

    for ($i = 0; $i < count($horses); $i++) {

        $pos = array_search($horses[$i], $track[$i]);
        $step = rand(1, 3);
        if ($pos === false) continue;
        $nextPos = $pos + $step;
        if ($nextPos > $length){
            $nextPos = $length;
        }
        if (!in_array($horses[$i], $finished)){
            $track[$i][$nextPos] = $horses[$i];
            $track[$i][$pos] = '-';
        }
        if ($nextPos === $length && !in_array($horses[$i], $finished)){
            $finished[] = $horses[$i];
        }


    }
    foreach ($track as $line) {
        echo implode('', $line);
        echo PHP_EOL;
    }
    $go++;
    sleep(1);


    foreach ($finished as $i=>$winner){
        $place = $i + 1;
        echo "#{$place} - $winner" . PHP_EOL;
    }

    if ($better === $finished[0]) {
        echo $bet * 3  . " dollars won!";
    } elseif ($better === $finished[1]) {
        echo $bet * 2 . " dollars won!";
    } elseif ($better === $finished[2]) {
        echo $bet . " dollars won!";
    } else {
        echo 'Thanks for the cash!';
    }
}
