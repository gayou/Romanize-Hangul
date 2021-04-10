# Romanize-Hangul
Romanize-Hangulはハングルで書かれたテキストをローマ字表記に変換するライブラリです。

PerlのLingua::KO::Romanize::Hangul ※1 というライブラリを参考に、  
PHPに移植してカタカナ変換を追加したものです。（主として人名をカタカナ表記にするためのものです）

※1  
https://metacpan.org/pod/distribution/Lingua-KO-Romanize-Hangul/lib/Lingua/KO/Romanize/Hangul.pm


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
　

## Todo
なにぶん10年以上前に作ったものなので以下の課題があります。

* ~テスト書いてない~ #2
* ~内部ロジック改善（10年以上前に作ったのであんまり覚えてない）~ #1
* composer.jsonの記述改善
　
　

## Changelog
* v0.1.0 Mar.24,2008 新規作成
* v0.2.0 Sep.??,2009 php5対応
* v0.3.0 Apr.03,2021 phpdocを書く, composer対応, メソッド名変更, githubに上げる
