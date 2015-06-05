<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use Tomaj\CsvProcessor\Processors\DateField;
use PHPUnit_Framework_TestCase;

class DateFieldTest extends PHPUnit_Framework_TestCase
{
    public function testPass()
    {
        $date1 = strtotime('10.3.2013');
        $date2 = strtotime('11.4.2015');

        $line = new Line(array('field1' => date('d.m.Y', $date1), 'field2' => date('m/d/Y', $date2)));

        $passFieldProcessor = new DateField('field1', 'field3');
        $passFieldProcessor->process($line);

        $passFieldProcessor = new DateField('field2', 'field4');
        $passFieldProcessor->process($line);

        $this->assertEquals($date1, $line->get('field3'));
        $this->assertEquals($date2, $line->get('field4'));
    }
}
