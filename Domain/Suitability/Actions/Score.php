<?php

namespace Domain\Suitability\Actions;
use Domain\Suitability\Exceptions\InvalidScoreLength;

class Score
{
    public float $baseScore = 0;
    public string $identity;
    public string $streetName;
    public string $driversName;

    public function execute(
        string $streetName,
        string $driversName
    ){

        ///oh we have a choice to make.  Do we truncate whitespace, special characters?
        /// I think yes, as a way of avoiding input error and incorrect scores
        $streetName = preg_replace('/[^a-zA-Z0-9-_]/','', $streetName);
        $length = strlen($streetName);

        //probably should build up some kind of nice response class? Maybe I'm undecided
        //making class variables instead
        $this->streetName = $streetName;
        $this->driversName = $driversName;

        if($length < 1){
            throw new InvalidScoreLength();
        }

        //calculate an even score
        if($this->isEven($length)){
            $oddScore = new CalculateEvenScore();
            $this->baseScore = $oddScore->execute($driversName);
            $this->identity = "even";
            return $this;
        }

        //calculate an odd score
        if($this->isOdd($length)){
            $oddScore = new CalculateOddScore();
            $this->baseScore = $oddScore->execute($driversName);
            $this->identity = "odd";
            return $this;
        }

        return $this;
    }

    private function isEven(int $length) : bool
    {
        if ($length % 2 == 0) {
            return true;
        }
        return false;
    }

    private function isOdd(int $length) : bool
    {
        if ($length % 2 !== 0) {
            return true;
        }
        return false;
    }
}