<?php

namespace Test;

use Tomaj\CsvProcessor\Processors\Processor;
use Tomaj\CsvProcessor\Line;

class MyProcessor extends Processor
{
    public function process(Line $line)
    {
        $line->set('myspecialkey', $line->get($this->inputField) . 'hash');
        $line->remove($this->outputField);
    }
}
