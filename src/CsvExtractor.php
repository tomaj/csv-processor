<?php

namespace Tomaj\CsvProcessor;

use Nette\IOException;
use Tomaj\CsvProcessor\Converters\ConverterInterface;

class CsvExtractor implements ExtractorInterface
{
	private $filePath;

	private $separator;

	private $skipFirstLines = 0;

	protected $keys = array();

	protected $lineConverters = array();

	public function __construct($filePath, $separator, $skipFirstLines = 0)
	{
		$this->filePath = $filePath;
		$this->separator = $separator;
		$this->skipFirstLines = $skipFirstLines;
	}

	public function loadData()
	{
		return $this->readFile($this->filePath);
	}

	public function addConverter(ConverterInterface $converter)
	{
		$this->lineConverters[] = $converter;
	}

	private function readFile($filePath)
	{
		$handle = fopen($filePath, 'r');
		if (!$handle) {
			throw new IOException("File '$filePath' cannot be opened");
		}
		$content = array();
		$counter = 0;
		while (($line = fgetcsv($handle, 1000, $this->separator)) !== false) {
			$line = $this->applyConverters($line);
			if ($counter == 0) {
				$this->keys = $line;
			} else {
				if ($counter > $this->skipFirstLines) {
					$content[] = $this->processFileLine($line);
				}
			}
			$counter++;
		}
		fclose($handle);
		return $content;
	}

	private function processFileLine($items)
	{
		$result = array();
		foreach ($items as $index => $item) {
			$result[ $this->keys[$index] ] = $item;
		}
		foreach ($this->keys as $key) {
			if (!array_key_exists($key, $result)) {
				$result[$key] = null;
			}
		}

		return $result;
	}

	private function applyConverters($line)
	{
		foreach ($this->lineConverters as $lineConverter) {
			if (is_array($line)) {
				foreach ($line as &$item) {
					$item = $lineConverter->convert($item);
				}
			} else {
				$line = $lineConverter->convert($line);
			}
		}
		return $line;
	}
}