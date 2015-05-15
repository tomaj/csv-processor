<?php

namespace Test;

use Tomaj\CsvProcessor\Line;
use Tomaj\CsvProcessor\Processors\DateField;
use PHPUnit_Framework_TestCase;

class DateFieldTest extends PHPUnit_Framework_TestCase
{
    public function testPass()
    {
        $line = new Line(array('field1' => '10.3.2013', 'field2' => '3/10/2013'));

        $passFieldProcessor = new DateField('field1', 'field3');
        $passFieldProcessor->process($line);

        $passFieldProcessor = new DateField('field2', 'field4');
        $passFieldProcessor->process($line);

        $this->assertEquals(1362870000, $line->get('field3'));
        $this->assertEquals(1362870000, $line->get('field4'));
    }
}
