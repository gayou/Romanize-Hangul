# Romanize-Hangul
Romanize-Hangul is a library that converts Hangul into Roman alphabet.

## Usage
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
　
 
## todo
* テスト書いてない
* 内部ロジック改善（10年以上前に作ったのであんまり覚えてない）
* composer.jsonの記述改善
　
 
## History
* v0.1.0 Mar.24,2008 新規作成
* v0.2.0 Sep.??,2009 php5対応
* v0.3.0 Apr.03,2021 phpdocを書く, composer対応, メソッド名変更, githubに上げる
