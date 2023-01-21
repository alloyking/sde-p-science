<?php

namespace Domain\Suitability\Actions;


class TallyScores
{
    public float $totalScore;

    public function __construct(
        public array $addresses,
        public array $drivers
    ){}


    public function execute(int $advance) : array
    {
        $loop = 0 + $advance;
        $location = [];
        $this->totalScore = 0;

        foreach ($this->addresses as $address){
            $address = new ParseAddress($address);
            $street = $address->getParsed()['street'];
            $score = new Score();
            $scoreObject = $score->execute($street, $this->drivers[$loop]);
            $location[$street] = $scoreObject;
            $this->totalScore =  $this->totalScore + $scoreObject->baseScore;
            $loop++;
            $loop = ( ($loop == count($this->addresses) ) ? 0 : $loop );
        }

        return $location;
    }
}