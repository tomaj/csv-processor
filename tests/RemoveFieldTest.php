<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use Tomaj\CsvProcessor\Processors\RemoveField;
use PHPUnit_Framework_TestCase;

class RemoveFieldTest extends PHPUnit_Framework_TestCase
{
    public function testRemove()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $passFieldProcessor = new RemoveField('field1');
        $passFieldProcessor->process($line);
        $this->assertEquals(1, $line->count());
        $this->assertEquals('hodnota2', $line->get('field2'));
    }

    /**
     * @expectedException \Tomaj\CsvProcessor\FieldNotExistsException
     */
    public function testRemoveNotExists()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $removeFieldProcessor = new RemoveField('field3');
        $removeFieldProcessor->process($line);
    }
}
