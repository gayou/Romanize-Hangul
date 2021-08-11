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


    public function testPersonNameBy권()
    {
        //Last Nameの場合は”クォン"
        //クォン・フィドン
        $this->assertSame(self::$hangul->katakana('권희동', true), 'クォン・フィドン');

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
        $hangul = new RomanizeHangul();

        //ヤン・ウイジ
        $this->assertSame($hangul->katakana('양의지', true), 'ヤン・ウイジ');
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
    }
}
