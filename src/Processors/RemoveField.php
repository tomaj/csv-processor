<?php

namespace Tomaj\CsvProcessor\Processors;

use Tomaj\CsvProcessor\Line;

class RemoveField extends Processor
{
	public function process(Line $input)
	{
		$input->remove($this->inputField);
	}
}