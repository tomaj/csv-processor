<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use PHPUnit_Framework_TestCase;

class LineTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $this->assertEquals('hodnota1', $line->get('field1'));
        $this->assertEquals('hodnota2', $line->get('field2'));
    }

    public function testSet()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $line->set('field3', 'hodnota3');
        $line->set('field2', 'hodnota4');
        $this->assertEquals('hodnota1', $line->get('field1'));
        $this->assertEquals('hodnota4', $line->get('field2'));
        $this->assertEquals('hodnota3', $line->get('field3'));
    }

    public function testMove()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $line->move('field2', 'field4');
        $this->assertEquals('hodnota1', $line->get('field1'));
        $this->assertEquals('hodnota2', $line->get('field4'));
    }

    public function testRemove()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $this->assertEquals('hodnota2', $line->get('field2'));
        $line->remove('field2');
        $this->assertEquals(1, $line->count());
        $this->assertEquals('hodnota1', $line->get('field1'));
    }

    public function testCount()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $this->assertEquals(2, $line->count());
    }

    public function testToArray()
    {
        $line = new Line(array('field1' => 'hodnota1', 'field2' => 'hodnota2'));
        $array = $line->getArray();
        $this->assertEquals(2, count($array));
        $this->assertEquals('hodnota1', $array['field1']);
        $this->assertEquals('hodnota2', $array['field2']);
    }
}
