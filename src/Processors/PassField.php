<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class PassField extends Processor
{
    private $delete;

    public function __construct($inputField, $outputField = null, $delete = true)
    {
        parent::__construct($inputField, $outputField);
        $this->delete = $delete;
    }

    public function process(Line $input)
    {
        if ($this->delete) {
            $input->move($this->inputField, $this->outputField);
        } else {
            $input->set($this->outputField, $input->get($this->inputField));
        }
        return $input;
    }
}
