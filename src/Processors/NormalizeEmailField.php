<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class NormalizeEmailField extends Processor
{
    public function process(Line $input)
    {
        $value = $input->get($this->inputField);

        $value = str_replace(array('<', '>'), '', $value);
        $input->remove($this->inputField);
        $input->set($this->outputField, $value);

        return $input;
    }
}
