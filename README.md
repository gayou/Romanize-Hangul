# Romanize-Hangul
Romanize-Hangulはハングルで書かれたテキストをローマ字表記に変換するライブラリです。

[Lingua::KO::Romanize::Hangul](https://metacpan.org/pod/distribution/Lingua-KO-Romanize-Hangul/lib/Lingua/KO/Romanize/Hangul.pm) というPerlのライブラリを参考に、  
PHPに移植してカタカナ変換を追加したもので、主に人名をカタカナ表記にするために利用できます。

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
| ver | 日付 | 更新内容 |
| --- | --- | ------- |
| 0.1.0 | Mar 24,2008 | 新規作成 |
| 0.2.0 | Sep ?,2009 | php5対応 |
| 0.3.0 | Apr 3,2021 | phpdoc記載, composer対応, メソッド名変更, githubでバージョン管理 |
| 0.4.x | Apr 11,2021- | カナ変換バグの修正, ユニットテスト追加 |
| 0.5.0 | Apr 8,2022 | カナ変換のマッピングを外部ファイル定義に移行 |
