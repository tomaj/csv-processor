**Prudko v development mode** - neoporucam pouzivat, zatial to je len vyextrahovane z projektu a nie su dobre zadefinovane zavyslosti

Pouzitie
========

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
$processor->addProcessor(new PassField('pi_tpn', 'tpn')); // field 'pi_tpn' z csvcka sa do vystupu dostane ako field 'tpn'
$processor->addProcessor(new RemoveField('field_ktory_sa_zmaze'));
$processor->processData($data, function(Line $line, $pid)) {
	// tu je mozne naimlementovat logiku co sa ma stat s $line kde su spracovane data
});
```
