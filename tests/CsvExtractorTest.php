<?php

namespace Test;

use Tomaj\CsvProcessor\CsvExtractor;
use PHPUnit_Framework_TestCase;

class CsvExtractorTest extends PHPUnit_Framework_TestCase
{
    public function testSimpleCsvFormat()
    {
        $csvExtractor = new CsvExtractor(dirname(__FILE__) . '/Data/simple.csv', ';');
        $result = $csvExtractor->loadData();

        $this->assertEquals(2, count($result));
        $this->assertEquals('hodnota1', $result[0]['key1']);
        $this->assertEquals('hodnota2', $result[0]['key2']);
        $this->assertEquals('hodnota3', $result[0]['key3']);
        $this->assertEquals('hodnota4', $result[1]['key1']);
        $this->assertEquals('hodnota5', $result[1]['key2']);
        $this->assertEquals('hodnota6', $result[1]['key3']);
    }

    public function testComplexCsvFormat()
    {
        $csvExtractor = new CsvExtractor(dirname(__FILE__) . '/Data/complex.csv', ';');
        $result = $csvExtractor->loadData();

        $this->assertEquals(2, count($result));
        $this->assertEquals('hodnota1', $result[0]['key1']);
        $this->assertEquals('hodnota2', $result[0]['key2']);
        $this->assertEquals('hodnota3', $result[0]['key3']);
        $this->assertEquals('hodnota4', $result[1]['key1']);
        $this->assertEquals('hodnota5', $result[1]['key2']);
        $this->assertEquals('hodnota6', $result[1]['key3']);
    }


    public function testCombinedCsvFormat()
    {
        $csvExtractor = new CsvExtractor(dirname(__FILE__) . '/Data/combined.csv', ';');
        $result = $csvExtractor->loadData();

        $this->assertEquals(2, count($result));
        $this->assertEquals('hodnota1', $result[0]['key1']);
        $this->assertEquals('hodnota2', $result[0]['key2']);
        $this->assertEquals('ho;;dnota3', $result[0]['key3']);
        $this->assertEquals('hodnota4', $result[1]['key1']);
        $this->assertEquals('hod;nota5', $result[1]['key2']);
        $this->assertEquals('hodnota6', $result[1]['key3']);
    }

    public function testSkipFirstLines()
    {
        $csvExtractor = new CsvExtractor(dirname(__FILE__) . '/Data/complex.csv', ';', 1);
        $result = $csvExtractor->loadData();

        $this->assertEquals(1, count($result));
        $this->assertEquals('hodnota4', $result[0]['key1']);
        $this->assertEquals('hodnota5', $result[0]['key2']);
        $this->assertEquals('hodnota6', $result[0]['key3']);
    }
}
