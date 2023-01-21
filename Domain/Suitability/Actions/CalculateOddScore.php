<?php

namespace Domain\Suitability\Actions;
use Domain\Suitability\Utilities\Actions\CleanStringsForScoreEvaluation;

class CalculateOddScore
{
    private CleanStringsForScoreEvaluation $cleanStringForScore;

    public function __construct()
    {
        $this->cleanStringForScore = new CleanStringsForScoreEvaluation();
    }
    public function execute(string $driversName) : int
    {
        // calculate number of consonants in the driver’s name multiplied by 1.
        return $this->consonantLength($driversName);
    }

    private function consonantLength($string = "") : int
    {
        //lowercase and remove anything that is not a letter.  Digits, special chars, spaces are not consonants (IMO)
        $strBuffer = $this->cleanStringForScore->execute($string);

        $initialLength = strlen($strBuffer);
        $vowels = array("a", "i", "u", "e", "o");
        $consonants = 0;

        for ($i = 0; $i <= $initialLength - 1; $i++) {
            if (!in_array($strBuffer[$i], $vowels)) {
                $consonants++;
            }
        }

        return $consonants;
    }
}