<?php

namespace Test;

use Tomaj\CsvProcessor\Converters\EncodingConverter;
use PHPUnit_Framework_TestCase;

class EncodingConverterTest extends PHPUnit_Framework_TestCase
{
    public function testConvertionFromWindowsToUtf8()
    {
        $encodingConverter = new EncodingConverter('WINDOWS-1250', 'UTF8');
        $input = file_get_contents(dirname(__FILE__) . '/Data/windows-encoding.txt');
        $output = $encodingConverter->convert($input);
        $result = "WEBid;TPN;Název;Popis;IKONA;Doplňkové info;Benefit;Cena jednotková;Cena jednotková EU;Cena stará;Cena stará EU;Cena akční;Cena akční EU;Leták č.;Typ;Platí od;Platí do;Neplatí v;Platí v;Newsletter";
        $this->assertEquals($result, $output);
    }
}
