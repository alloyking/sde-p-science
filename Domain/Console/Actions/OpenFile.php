<?php

namespace Domain\Console\Actions;

use Domain\Console\Exceptions\FileNotFoundException;
use Domain\Console\Exceptions\FileOpenException;

class OpenFile
{
    private array $content;

    public function execute($fileName) : void
    {
        try
        {
            if ( !file_exists($fileName) ) {
                //file did not exist
                throw new FileNotFoundException();
            }

            //open the file (try)
            $handle = fopen($fileName, "r");

            if(!$handle){
                //file coud not be opened
                throw new FileOpenException();
            }

            $this->content = [];

            //write our content line by line to an array
            while (($line = fgets($handle)) !== false) {
                $this->content[] = $line;
            }
            fclose($handle);
        } catch ( Exception $e ) {
            //todo
            //I could probably do something here
        }

    }

    public function getContent() : array
    {
        return $this->content;
    }
}