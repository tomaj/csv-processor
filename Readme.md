Csv processor
=============

Kniznica pre procesovanie csvciek

**Prudko v development mode** - neoporucam pouzivat, zatial to je len vyextrahovane z projektu a nie su dobre zadefinovane zavyslosti

[![Build Status](https://secure.travis-ci.org/tomaj/csv-processor.png)](http://travis-ci.org/tomaj/csv-processor)
[![Code Climate](https://codeclimate.com/github/tomaj/csv-processor/badges/gpa.svg)](https://codeclimate.com/github/tomaj/csv-processor)
[![Test Coverage](https://codeclimate.com/github/tomaj/csv-processor/badges/coverage.svg)](https://codeclimate.com/github/tomaj/csv-processor/coverage)
[![Dependency Status](https://www.versioneye.com/user/projects/5555b08f774ff250e2000115/badge.svg?style=flat)](https://www.versioneye.com/user/projects/5555b08f774ff250e2000115)

[![Latest Stable Version](https://poser.pugx.org/tomaj/csv-processor/v/stable)](https://packagist.org/packages/tomaj/csv-processor) [![Total Downloads](https://poser.pugx.org/tomaj/csv-processor/downloads)](https://packagist.org/packages/tomaj/csv-processor) [![Latest Unstable Version](https://poser.pugx.org/tomaj/csv-processor/v/unstable)](https://packagist.org/packages/tomaj/csv-processor) [![License](https://poser.pugx.org/tomaj/csv-processor/license)](https://packagist.org/packages/tomaj/csv-processor)

Pouzitie
--------

Kazdy import je zlozeny z 3 casti.

1. Extractor - existuju 2 aktualne, pre csv a zip subory. Jeho ulohou je nacitat data zo vstupu
2. Procesor - trieda do ktorej je potrebne nastavit jednotlive procesory na fieldy.
3. Implementacia biznis logiky s datami ktore sa nacitali a spracovali.

Prakticky to moze vyzerat takto:

```php
use Tomaj\CsvProcessor\CsvExtractor;
use Tomaj\CsvProcessor\DataProcessor;
use Tomaj\CsvProcessor\Converters\EncodingConverter;
use Tomaj\CsvProcessor\Processors\PassField;
use Tomaj\CsvProcessor\Processors\RemoveField;
use Tomaj\CsvProcessor\Line;

$csvExtractor = new CsvExtractor('cesta_k_suboru_.csv', ';');
$csvExtractor->addConverter(new EncodingConverter('WINDOWS-1250', 'UTF-8')); // mozme nastavit konverziu ak treba
$data = $csvExtractor->loadData();

$processor = new DataProcessor($output);
$processor->addProcessor(new PassField('field_name', 'name')); // field 'file_name' z csvcka sa do vystupu dostane ako field 'name'
$processor->addProcessor(new RemoveField('field_ktory_sa_zmaze'));
$processor->processData($data, function(Line $line, $pid)) {
	// tu je mozne naimlementovat logiku co sa ma stat s $line kde su spracovane data
});
```
