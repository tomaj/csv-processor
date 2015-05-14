<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class DateField extends Processor
{
	private $endDay = false;

	public function __construct($inputField, $outputField = null, $endDay = false)
	{
		$this->inputField = $inputField;
		$this->outputField = $outputField;
		$this->endDay = $endDay;
	}

	public function process(Line $input)
	{
		$date = $input->get($this->inputField);
		$result = strtotime($date);
		if ($this->endDay) {
			$result += 86399; // end day
		}
		$input->remove($this->inputField);
		$input->set($this->outputField, $result);
	}
}
