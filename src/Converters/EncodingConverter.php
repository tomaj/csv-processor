<?php

namespace Tomaj\CsvProcessor\Converters;

class EncodingConverter implements ConverterInterface
{
	private $inputEncoding;

	private $outputEncoding;

	public function __construct($inputEncoding, $outputEncoding)
	{
		if (!extension_loaded('iconv')) {
			throw new \Nette\InvalidStateException('PHP Module iconv must be loaded');
		}
		$this->inputEncoding = $inputEncoding;
		$this->outputEncoding = $outputEncoding;
	}

	public function convert($input)
	{
		return iconv($this->inputEncoding, $this->outputEncoding, $input);
	}
}
