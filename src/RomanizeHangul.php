<?php namespace Gayou\Romanize;
 
/**
 * ハングル ローマ字表記変換
 *
 * ハングルのテキストを文化観光部2000年式のローマ字表記に変換する
 *
 * @author gayou
 * @version 0.5.0
 */
class RomanizeHangul
{
    private const MAPPING_PATH = __DIR__.'/../config/mapping.ini';

    private $initial = array("g", "kk", "n", "d", "tt", "r", "m", "b", "pp", "s", "ss", "", "j", "jj", "ch", "k", "t", "p", "h");
    private $peak = array("a", "ae", "ya", "yae", "eo", "e", "yeo", "ye", "o", "wa", "wae", "oe", "yo", "u", "wo", "we", "wi", "yu", "eu", "ui", "i");
    private $final = array("", "g", "kk", "ks", "n", "nj", "nh", "d", "r", "lg", "lm", "lb", "ls", "lt", "lp", "lh", "m", "b", "ps", "s", "ss", "ng", "j", "c", "k", "t", "p", "h");
    
    private $search;
    private $replace;

    private $searchFirstName;
    private $replaceFirstName;

    /**
     * コンストラクタ
     *
     * @param string $str
     * @param boolean $isUcFirst
     * @return string
     */
    public function __construct()
    {
        //マッピングファイル読み込み
        $config = $this->loadMappping();

        $this->search  = array_keys($config['katakana']);
        $this->replace = array_values($config['katakana']);

        $this->searchFirstName = array_keys(array_merge($config['katakana'], $config['firstname']));
        $this->replaceFirstName = array_values(array_merge($config['katakana'], $config['firstname']));
    }

    
    /**
     * マッピングファイルを読み込む
     *
     * @param string $filepath
     * @return array
     */
    private function loadMappping(string $filepath = self::MAPPING_PATH) : array
    {
        // $config = parse_ini_file($filepath, true, INI_SCANNER_TYPED);
        return parse_ini_file($filepath, true, INI_SCANNER_RAW);
    }


    /**
     * ハングルをローマ字表記に変換
     *
     * @param string $str
     * @param boolean $isUcFirst
     * @return string
     */
    public function romanize(string $str, bool $isUcFirst = false) :string
    {
        $tmpStr = null;
        $outStr = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i++) {
            $tmpStr = mb_substr($str, $i, 1, "UTF-8");
            $ucs2 = bin2hex(mb_convert_encoding($tmpStr, "UCS-2", "UTF-8"));
            $ucs2 = hexdec($ucs2);
            if ($ucs2 >= 0xAC00 && $ucs2 <= 0xD7A3) {
                $han = $ucs2 - 0xAC00;
                $init = intval($han / 21 / 28);
                $peak = intval($han / 28) % 21;
                $fin  = $han % 28;
                $tmpStr = $this->initial[$init].$this->peak[$peak].$this->final[$fin];
            } else {
                $tmpStr = $tmpStr;
            }
            
            $outStr[] = $tmpStr;
        }
        
        //子音表記の調整
        $len = count($outStr);
        for ($i = 0; $i < $len-1; $i++) {
            $thisStr = $outStr[$i];
            $nextStr = $outStr[$i+1];
            $novowel = preg_match("/^[^aeouiwy]/", $nextStr);
                
            if (preg_match("/(tt|pp|jj)$/", $thisStr) && $novowel) {
                $outStr[$i] = preg_replace("/(tt|pp|jj)$/", "", $thisStr);
            } elseif (preg_match("/([^n]g|kk)$/", $thisStr) && $novowel) {
                $outStr[$i] = preg_replace("/(g|kk)$/", "k", $thisStr);
            } elseif (preg_match("/(d|j|ch|s?s)$/", $thisStr) && $novowel) {
                $outStr[$i] = preg_replace("/(d|j|ch|s?s)$/", "t", $thisStr);
            } elseif (preg_match("/(b)$/", $thisStr) && $novowel) {
                $outStr[$i] = preg_replace("/(b)$/", "p", $thisStr);
            } elseif (preg_match("/(r)$/", $thisStr) && $novowel) {
                $outStr[$i] = preg_replace("/(r)$/", "l", $thisStr);
                $outStr[$i+1] = preg_replace("/^r/", "l", $nextStr);
            }
        }
        $outStr = implode('', $outStr);
        
        return ($isUcFirst)? ucfirst($outStr): $outStr;
    }
    
    
    /**
     * ハングルをカタカナ表記に変換
     *
     * @param string $str
     * @param boolean 人名をカタカナ表記にする場合はtrue
     * @param string 人名をカタカナ表記にする場合の姓と名の間の文字
     * @return string
     */
    public function katakana(string $str, bool $personName = false, string $personNameSeparate = '・') : string
    {
        //ハングルチェック
        mb_regex_encoding("UTF-8");
        if (!mb_ereg("[가-힣]+", $str)) {
            return $str;
        }
        
        if ($personName) {
            //姓・名 分割
            $lastName = mb_substr($str, 0, 1);
            $firstNames = mb_str_split(mb_substr($str, 1));

            //姓
            $lastName = $this->romanize($lastName);
            $lastName = str_replace($this->searchFirstName, $this->replaceFirstName, $lastName);

            //名
            $firstName = '';
            foreach ($firstNames as $name) {
                $name = $this->romanize($name);
                $firstName .= str_replace($this->search, $this->replace, $name);
            }

            return $lastName.$personNameSeparate.$firstName;
        } else {
            //人名以外の場合
            $roman = $this->romanize($str);

            return str_replace($this->search, $this->replace, $roman);
        }
    }
}
