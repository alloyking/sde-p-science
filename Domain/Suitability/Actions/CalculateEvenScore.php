<?php

namespace Domain\Suitability\Actions;

use Domain\Suitability\Utilities\Actions\CleanStringsForScoreEvaluation;

class CalculateEvenScore
{
    const MULTIPLIER = 1.5;
    private CleanStringsForScoreEvaluation $cleanStringForScore;

    public function __construct()
    {
        $this->cleanStringForScore = new CleanStringsForScoreEvaluation();
    }
    public function execute(string $driversName) : float
    {
        // calculate number of vowels in the driver’s name multiplied by 1.5.
        return $this->vowelsLength($driversName) * self::MULTIPLIER;
    }

    private function vowelsLength($string = "") : int
    {
        //lowercase and remove anything that is not a letter.  Digits, special chars, spaces are not consonants (IMO)
        $strBuffer = $this->cleanStringForScore->execute($string);

        $vowels = array("a", "i", "u", "e", "o");
        $foundVowels = 0;

        for ($i = 0; $i <= strlen($strBuffer) - 1; $i++) {
            if (in_array(strtolower($strBuffer[$i]), $vowels)) {
                $foundVowels++;
            }
        }

        return $foundVowels;
    }
}