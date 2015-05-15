<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use Tomaj\CsvProcessor\Processors\RemoveIfExistsField;
use PHPUnit_Framework_TestCase;

class RemoveIfExistsFieldTest extends PHPUnit_Framework_TestCase
{
    public function testRemove()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $passFieldProcessor = new RemoveIfExistsField('field1');
        $passFieldProcessor->process($line);
        $this->assertEquals(1, $line->count());
        $this->assertEquals('hodnota2', $line->get('field2'));
    }

    public function testRemoveNotExists()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $removeFieldProcessor = new RemoveIfExistsField('field3');
        $removeFieldProcessor->process($line);
        $this->assertEquals(2, $line->count());
        $this->assertEquals('hodnota1', $line->get('field1'));
        $this->assertEquals('hodnota2', $line->get('field2'));
    }
}
