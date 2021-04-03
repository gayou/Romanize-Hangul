# Romanize-Hangul
Romanize-Hangul is a library that converts Hangul into Roman alphabet.

## usage
### sample code
```php
use Gayou\Romanize\RomanizeHangul;

$hangul = new RomanizeHangul();
$str = "박해민";

echo $hangul->romanize($str).PHP_EOL;
echo $hangul->katakana($str, true).PHP_EOL;
```

### result
```
bakhaemin
パク・ヘミン
```
