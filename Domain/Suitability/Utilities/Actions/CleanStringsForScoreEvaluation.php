<?php

namespace Domain\Suitability\Utilities\Actions;

class CleanStringsForScoreEvaluation
{
    public function execute(string $string) : string
    {
        //lowercase and remove anything that is not a letter.  Digits, special chars, spaces are not consonants or vowels (IMO)
        return strtolower(
            preg_replace('/[^A-Za-z]/', '', $string)
        );
    }
}