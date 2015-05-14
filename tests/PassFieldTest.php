<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use Tomaj\CsvProcessor\Processors\PassField;
use PHPUnit_Framework_TestCase;

class PassFieldTest extends PHPUnit_Framework_TestCase
{
	function testPass()
	{
		$line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
		$passFieldProcessor = new PassField('field1', 'field3');
		$passFieldProcessor->process($line);
		$this->assertEquals(2, $line->count());
		$this->assertEquals('hodnota1', $line->get('field3'));
	}

	function testPassWithoutDelete()
	{
		$line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
		$passFieldProcessor = new PassField('field1', 'field3', FALSE);
		$passFieldProcessor->process($line);
		$this->assertEquals(3, $line->count());
		$this->assertEquals('hodnota1', $line->get('field1'));
		$this->assertEquals('hodnota2', $line->get('field2'));
		$this->assertEquals('hodnota1', $line->get('field3'));
	}
}
