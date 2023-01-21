<?php

namespace Domain\Suitability\Exceptions;

use Exception;

class InvalidDriversName extends Exception
{
    private const MESSAGE = 'The provided DriversName is either invalid or null';

    public function __construct()
    {
        parent::__construct(static::MESSAGE, 0);
    }
}