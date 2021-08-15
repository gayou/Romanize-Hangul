<?php namespace Gayou\Romanize;
 
/**
 * ハングル ローマ字表記変換
 *
 * ハングルのテキストを文化観光部2000年式のローマ字表記に変換する
 *
 * @author gayou
 * @version v0.4.5
 */
class RomanizeHangul
{
    
    private $initial = array("g", "kk", "n", "d", "tt", "r", "m", "b", "pp", "s", "ss", "", "j", "jj", "ch", "k", "t", "p", "h");
    private $peak = array("a", "ae", "ya", "yae", "eo", "e", "yeo", "ye", "o", "wa", "wae", "oe", "yo", "u", "wo", "we", "wi", "yu", "eu", "ui", "i");
    private $final = array("", "g", "kk", "ks", "n", "nj", "nh", "d", "r", "lg", "lm", "lb", "ls", "lt", "lp", "lh", "m", "b", "ps", "s", "ss", "ng", "j", "c", "k", "t", "p", "h");
    
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
            //人名の場合
            $lastName = mb_substr($str, 0, 1);
            $firstName = mb_substr($str, 1);

            //姓
            $lastName = $this->romanize($lastName);
            $search = array_keys($this->kana4first);
            $replace = array_values($this->kana4first);
            $lastName = str_replace($search, $replace, $lastName);

            $search = array_keys($this->kana);
            $replace = array_values($this->kana);
            $lastName = str_replace($search, $replace, $lastName);

            //名
            $firstName = $this->romanize($firstName);
            $firstName = str_replace($search, $replace, $firstName);

            return $lastName.$personNameSeparate.$firstName;
        } else {
            //人名以外の場合
            $roman = $this->romanize($str);
            $search = array_keys($this->kana);
            $replace = array_values($this->kana);

            return str_replace($search, $replace, $roman);
        }
    }
    
    private $kana4first = array(
        'jeo' => 'チョ',
        'gwo' => 'クォ',
    
        'geu' => 'ク',
    
        'ga' => 'カ',
        'gi' => 'キ',
        'gu' => 'ク',
        'go' => 'コ',
        'ja' => 'チャ',
        'ji' => 'チ',
        'ju' => 'チュ',
        'je' => 'チェ',
        'jo' => 'チョ',
        
        'bo' => 'ポ'
    );

    private $kana = array(
        'ngu'   => 'ング',

        'ng'   => 'ン',

        'keur' => 'ク',
        
        'hyeo' => 'ヒョ',
        'myeo' => 'ミョ',
        'nyeo' => 'ニョ',
        'gyeo' => 'ギョ',
        'cheo' => 'チョ',
        'byeo' => 'ビョ',
        'pyeo' => 'ピョ',
        'chae' => 'チェ',
        'choe' => 'チェ',
        'ryeo' => 'リョ',
        
        'dae' => 'デ',
        'jae' => 'ジェ',
        'jeo' => 'ジョ',
        'yeo' => 'ヨ',
        'geo' => 'ゴ',
        'seo' => 'ソ',
        'beo' => 'ボ',
        'heo' => 'ホ',
        
        'deu' => 'ドゥ',
        'deo' => 'ド',
        'geu' => 'グ',
        'keu' => 'ク',
        'gye' => 'ケ',
        'sae' => 'セ',
        'seu' => 'ス',
        'jeu' => 'ジュ',
        'heu' => 'フ',
        'beu' => 'ブ',
        'peu' => 'プ',
        'reu' => 'ル',
        'teu' => 'トゥ',
        'eu'  => 'ウ',
        
        'hya' => 'ヒャ',
        'hwa' => 'ファ',
        'hwi' => 'フィ',
        'hui' => 'ヒ',
        'hye' => 'ヘ',
        'hoe' => 'フェ',
        'hyo' => 'ヒョ',
        'gwa' => 'グァ',
        'gwi' => 'ギィ',
        'gwo' => 'グォ',
        
        'cha' => 'チャ',
        'chu' => 'チュ',
        'gyu' => 'ギュ',
        
        'bae' => 'ペ',
        'pae' => 'ペ',
        'peo' => 'ポ',
        'tae' => 'テ',
        'hae' => 'ヘ',
        'mae' => 'メ',
        'teo' => 'ト',
        
        'pyo' => 'ピョ',
        'ryu' => 'リュ',
        
        //'ir' => 'イル',
        
        'eo' => 'オ',
        'ka' => 'カ',
        'ki' => 'キ',
        'ko' => 'コ',
        
        'sa' => 'サ',
        'si' => 'シ',
        'su' => 'ス',
        'se' => 'セ',
        'so' => 'ソ',
        
        'ga' => 'ガ',
        'gi' => 'ギ',
        'gu' => 'グ',
        'go' => 'ゴ',

        'ja' => 'ジャ',
        'ji' => 'ジ',
        'ju' => 'ジュ',
        'jo' => 'チョ',
        'je' => 'ジェ',
        
        'ta' => 'タ',
        'chi' => 'チ',
        'to' => 'トー',
        'da' => 'ダ',
        'du' => 'ドゥ',
        'de' => 'デ',
        'di' => 'ディ',
        'do' => 'ド',
        'tu' => 'トゥ',
        
        'pa' => 'ファ',
        'ba' => 'パ',
        'bi' => 'ビ',
        'pi' => 'ピ',
        'pu' => 'プ',
        'pe' => 'ペ',
        'be' => 'ペ',
        'bo' => 'ボ',
        'po' => 'ポ',
        
        'ha' => 'ハ',
        'hi' => 'ヒ',
        'hu' => 'フ',
        'he' => 'ヘ',
        'ho' => 'ホ',
        
        'ma' => 'マ',
        'mi' => 'ミ',
        'mu' => 'ム',
        'mo' => 'モ',
        
        'ya' => 'ヤ',
        'yu' => 'ユ',
        'yo' => 'ヨ',
        'ye' => 'イェ',
        
        'ra' => 'ラ',
        'ri' => 'リ',
        'ru' => 'ルー',
        'ro' => 'ロ',
        'lo' => 'ロ',
        
        'wa' => 'ワ',
        'wo' => 'ウォ',
        
        
        'na' => 'ナ',
        'ni' => 'ニ',
        're' => 'レ',
        'ne' => 'ネ',
        'no' => 'ノ',

        'ye' => 'イェ',
        
        'm' => 'ム',
    
        'a' => 'ア',
        'i' => 'イ',
        'u' => 'ウ',
        'o' => 'オ',
        
        's' => 'ス',
        't' => 'ト',
        'b' => 'プ',
        'r' => 'ル',
        'l' => 'ル',
        'k' => 'ク',
        'g' => 'ク',
        'n' => 'ン'
    );
}
