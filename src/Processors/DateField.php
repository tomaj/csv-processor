<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class DateField extends Processor
{
    private $endDay = false;

    public function __construct($inputField, $outputField = null)
    {
        $this->inputField = $inputField;
        $this->outputField = $outputField;
    }

    public function process(Line $input)
    {
        $date = $input->get($this->inputField);
        $result = strtotime($date);
        $input->remove($this->inputField);
        $input->set($this->outputField, $result);
    }
}
