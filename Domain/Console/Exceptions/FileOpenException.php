<?php

namespace Domain\Console\Exceptions;
use Exception;
class FileOpenException extends Exception
{
    private const MESSAGE = 'Opening the file failes';

    public function __construct()
    {
        parent::__construct(static::MESSAGE,0);
    }
}