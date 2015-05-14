<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class RemoveIfExistsField extends Processor
{
	public function process(Line $input)
	{
		if ($input->exists($this->inputField)) {
			$input->remove($this->inputField);
		}
	}
}