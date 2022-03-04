# Romanize-Hangul
Romanize-Hangulはハングルで書かれたテキストをローマ字表記に変換するライブラリです。

[Lingua::KO::Romanize::Hangul](https://metacpan.org/pod/distribution/Lingua-KO-Romanize-Hangul/lib/Lingua/KO/Romanize/Hangul.pm) というPerlのライブラリを参考に、  
PHPに移植してカタカナ変換を追加したもので、主として人名をカタカナ表記にするために利用できます。

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

## Changelog
* v0.1.0 Mar.24,2008 新規作成
* v0.2.0 Sep.??,2009 php5対応
* v0.3.0 Apr.03,2021 phpdocを書く, composer対応, メソッド名変更, githubに上げる
* v0.4.x Apr.11,2021〜 既存バグの修正,ユニットテスト追加を取り組み中
