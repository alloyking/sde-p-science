<?php
namespace Domain\Suitability\Exceptions;

use Exception;

class InvalidGeoapifyResponse extends Exception
{
    private const MESSAGE = 'geoapify api not responding.';

    public function __construct()
    {
        parent::__construct(static::MESSAGE, 404);
    }
}
