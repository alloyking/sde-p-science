<?php

include_once(__DIR__.'/vendor/autoload.php');


use Domain\Console\Actions\OpenFile;
use Domain\Suitability\Actions\TallyScores;

// %> php sde.php addresses.txt drivers.txt
$streetAddressesFile = $argv[1];
$driverNamesFile = $argv[2];


//open our files
$open = new OpenFile();
$open->execute($streetAddressesFile);
$addresses = $open->getContent();

$open->execute($driverNamesFile);
$drivers = $open->getContent();




//build an array of each location and the scores of each driver
//We do this count(addresses) times.  In this way we have all the possible shipping method and scores
//picture something like this:

/*
$addresses[0], $drivers[0]
$addresses[1], $drivers[1]
$addresses[2], $drivers[2];


$addresses[0], $drivers[1]
$addresses[1], $drivers[2]
$addresses[2], $drivers[0];
....

This will give us a way to compare the scores if we look at the total suitability score across all possible shipping paths.

*/

$locations = [];
$tallyScores = new TallyScores($addresses, $drivers);
for($i=0; $i<count($addresses); $i++){
    $tallyArray = $tallyScores->execute($i);
    $tallyArray['total'] = $tallyScores->totalScore;
    $locations[] = $tallyArray;
}

//arsort fails here with float values (who knew?!!)
usort($locations, function($a, $b){
    return $b['total'] > $a['total'] ? 1 : -1;
});

//construct a response here
$output = [
    'best suitability' => current($locations),
    'all possible combinations' => $locations,
];

print_r($output);
exit();
