<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

abstract class Processor
{
    public $inputField;

    public $outputField;

    public function __construct($inputField, $outputField = null)
    {
        $this->inputField = $inputField;
        $this->outputField = $outputField;
    }

    abstract public function process(Line $input);
}
