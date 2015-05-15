<?php

namespace Test;

use Symfony\Component\Console\Output\NullOutput;
use Tomaj\CsvProcessor\DataProcessor;
use Tomaj\CsvProcessor\Line;
use PHPUnit_Framework_TestCase;

require_once __DIR__ . '/MyProcessor.php';

class DataProcessorTest extends PHPUnit_Framework_TestCase
{
    public function testOneLineProcess()
    {
        $input = array(
            'key1' => 'asdsad',
            'key2' => 'sdgdsgdsf',
            'key4' => '234t4325',
        );

        $dataProcessor = new DataProcessor(new NullOutput(), null, 12);
        $dataProcessor->processLine($input, function (Line $line, $pid) {
            $this->assertEquals('asdsad', $line->get('key1'));
            $this->assertEquals('sdgdsgdsf', $line->get('key2'));
            $this->assertEquals('234t4325', $line->get('key4'));

            $this->assertEquals(12, $pid);
        });
    }

    public function testLinesProcessWithProcessor()
    {
        $input = array(array(
            'key1' => 'asdsad',
            'key2' => 'sdgdsgdsf',
            'key4' => '234t4325',
        ));

        $dataProcessor = new DataProcessor(new NullOutput(), null, 12);
        $dataProcessor->addProcessor(new MyProcessor('key1', 'key2'));
        $dataProcessor->processData($input, function (Line $line, $pid) {
            $this->assertEquals(3, $line->count());
            $this->assertEquals('asdsadhash', $line->get('myspecialkey'));
            $this->assertEquals('asdsad', $line->get('key1'));
            $this->assertEquals('234t4325', $line->get('key4'));

            $this->assertEquals(12, $pid);
        });
    }
}
