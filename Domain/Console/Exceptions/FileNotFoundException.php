<?php

namespace Domain\Console\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    private const MESSAGE = 'The File was not found at the given path';

    public function __construct()
    {
        parent::__construct(static::MESSAGE, 0);
    }
}