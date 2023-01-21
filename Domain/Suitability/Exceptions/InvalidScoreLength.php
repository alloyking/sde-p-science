<?php

namespace Domain\Suitability\Exceptions;

use Exception;

class InvalidScoreLength extends Exception
{
    private const MESSAGE = 'The string provided to the scoring method is too short';

    public function __construct()
    {
        parent::__construct(static::MESSAGE, 0);
    }
}