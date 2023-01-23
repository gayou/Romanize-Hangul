<?php namespace Gayou\Romanize\Test;

use PHPUnit\Framework\TestCase;
use Gayou\Romanize\RomanizeHangul;

class RomanizeHangulTest extends TestCase
{
    private static $hangul;

    public static function setUpBeforeClass(): void
    {
        self::$hangul = new RomanizeHangul();
    }


    public function testLoadMapping()
    {
        //iniファイルを読み込んで、$config['katakana']['no`]が存在するかをチェック
        //  ->予約語エラー回避のため「 no=ノ」 のように先頭に半角スペースを入れている
        //  ->$configはlocal変数なので、代わりに$searchに'no'が含まれていればOKとする
        $reflection = new \ReflectionClass(self::$hangul);
        $property = $reflection->getProperty('search');
        $property->setAccessible(true);
        $result = $property->getValue(self::$hangul);
        $this->assertTrue(in_array('no', $result));;
    }


    public function testPersonNameBy권()
    {
        //Last Nameの場合は”クォン"
        //クォン・ヒドン
        $this->assertSame(self::$hangul->katakana('권희동', true), 'クォン・ヒドン');

        //First Nameの場合は"グォン"
        //アン・グォンス
        $this->assertSame(self::$hangul->katakana('안권수', true), 'アン・グォンス');
    }


    public function testPersonNameBy주()
    {
        //Last Nameの場合は”チュ"
        $this->assertSame(self::$hangul->katakana('주권', true), 'チュ・グォン');

        //First Nameの場合は"ジュ"
        $this->assertSame(self::$hangul->katakana('정주현', true), 'チョン・ジュヒョン');
        $this->assertSame(self::$hangul->katakana('이학주', true), 'イ・ハクジュ');
    }


    public function testPersonNameByLee()
    {
        //イ・デホ
        $this->assertSame(self::$hangul->katakana('이대호', true), 'イ・デホ');

        //イ・スンヨプ
        $this->assertSame(self::$hangul->katakana('이승엽', true), 'イ・スンヨプ');
    }


    public function testPersonNameByKim()
    {
        //キム・グァンヒョン
        $this->assertSame(self::$hangul->katakana('김광현', true), 'キム・グァンヒョン');

        //キム・テギュン
        $this->assertSame(self::$hangul->katakana('김태균', true), 'キム・テギュン');
    }


    public function testPersonNameByPark()
    {
        //パク・ミンウ
        $this->assertSame(self::$hangul->katakana('박민우', true), 'パク・ミンウ');
    }


    public function testPersonNameByNa()
    {
        //ナ・ソンボム
        $this->assertSame(self::$hangul->katakana('나성범', true), 'ナ・ソンボム');
    }


    public function testPersonNameByYang()
    {
        //ヤン・ウィジ
        $this->assertSame(self::$hangul->katakana('양의지', true), 'ヤン・ウィジ');
    }


    public function testPersonNameByko()
    {
        //コ・ヨンピョ
        $this->assertSame(self::$hangul->katakana('고영표', true), 'コ・ヨンピョ');

        //コ・ウソク
        $this->assertSame(self::$hangul->katakana('고우석', true), 'コ・ウソク');
    }


    public function testPersonNameByForeign()
    {
        //キンガム
        $this->assertSame(self::$hangul->katakana('킹험', true), 'キン・ホム');
    }


    public function testPersonNameBy구()
    {
        //カン・ユング
        $this->assertSame(self::$hangul->katakana('강윤구', true), 'カン・ユング');

        //ク・チャンモ
        $this->assertSame(self::$hangul->katakana('구창모', true), 'ク・チャンモ');

        //ク・ボンヒョク
        $this->assertSame(self::$hangul->katakana('구본혁', true), 'ク・ボンヒョク');

        //ク・ジャウク
        $this->assertSame(self::$hangul->katakana('구자욱', true), 'ク・ジャウク');
    }


    public function testPersonNameBy희()
    {
        //イ・ジェヒ
        $this->assertSame(self::$hangul->katakana('이재희', true), 'イ・ジェヒ');
    }


    public function testPersonNameBy도()
    {
        //Last Nameの場合は"ト"
        //ト・テフン
        $this->assertSame(self::$hangul->katakana('도태훈', true), 'ト・テフン');

        //First Nameの場合は"ド"
        $this->assertSame(self::$hangul->katakana('권희동', true), 'クォン・ヒドン');
    }


    public function testPersonNameBy게()
    {
        //パク・ケボム
        $this->assertSame(self::$hangul->katakana('박게범', true), 'パク・ケボム');
    }


    public function testPersonNameBy기()
    {
        //シン・ボンギ
        $this->assertSame(self::$hangul->katakana('신본기', true), 'シン・ボンギ');
    }


    public function testPersonNameBy의()
    {
        //ソン・チャンウィ
        $this->assertSame(self::$hangul->katakana('송찬의', true), 'ソン・チャンウィ');
    }


    public function testPersonNameBy노()
    {
        //ノ・ギョンウン
        $this->assertSame(self::$hangul->katakana('노경은', true), 'ノ・ギョンウン');
    }


    public function testPersonNameBy위()
    {
        //ウィ・ジェミン
        $this->assertSame(self::$hangul->katakana('위재민', true), 'ウィ・ジェミン');
    }
}
