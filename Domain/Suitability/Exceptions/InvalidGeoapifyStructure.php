<?php
namespace Domain\Suitability\Exceptions;

use Exception;

class InvalidGeoapifyStructure extends Exception
{
    private const MESSAGE = 'The structure of the geoapify response is invalid.';

    public function __construct()
    {
        parent::__construct(static::MESSAGE, 0);
    }

}
