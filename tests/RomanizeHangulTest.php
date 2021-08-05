<?php namespace Gayou\Romanize\Test;

use PHPUnit\Framework\TestCase;
use Gayou\Romanize\RomanizeHangul;

class RomanizeHangulTest extends TestCase
{
    public function testPersonNameBy권()
    {
        $hangul = new RomanizeHangul();

        //Last Nameの場合は”クォン"
        //クォン・フィドン
        $this->assertSame($hangul->katakana('권희동', true), 'クォン・フィドン');

        //First Nameの場合は"グォン"
        //アン・グォンス
        $this->assertSame($hangul->katakana('안권수', true), 'アン・グォンス');
    }


    public function testPersonNameBy주()
    {
        $hangul = new RomanizeHangul();
        
        //Last Nameの場合は”チュ"
        $this->assertSame($hangul->katakana('주권', true), 'チュ・グォン');

        //First Nameの場合は"ジュ"
        $this->assertSame($hangul->katakana('정주현', true), 'チョン・ジュヒョン');
        $this->assertSame($hangul->katakana('이학주', true), 'イ・ハクジュ');
    }


    public function testPersonNameByLee()
    {
        $hangul = new RomanizeHangul();

        //イ・デホ
        $this->assertSame($hangul->katakana('이대호', true), 'イ・デホ');

        //イ・スンヨプ
        $this->assertSame($hangul->katakana('이승엽', true), 'イ・スンヨプ');
    }


    public function testPersonNameByKim()
    {
        $hangul = new RomanizeHangul();

        //キム・グァンヒョン
        $this->assertSame($hangul->katakana('김광현', true), 'キム・グァンヒョン');

        //キム・テギュン
        $this->assertSame($hangul->katakana('김태균', true), 'キム・テギュン');
    }


    public function testPersonNameByPark()
    {
        $hangul = new RomanizeHangul();

        //パク・ミンウ
        $this->assertSame($hangul->katakana('박민우', true), 'パク・ミンウ');
    }


    public function testPersonNameByNa()
    {
        $hangul = new RomanizeHangul();

        //ナ・ソンボム
        $this->assertSame($hangul->katakana('나성범', true), 'ナ・ソンボム');
    }


    public function testPersonNameByYang()
    {
        $hangul = new RomanizeHangul();

        //ヤン・ウイジ
        $this->assertSame($hangul->katakana('양의지', true), 'ヤン・ウイジ');
    }


    public function testPersonNameByko()
    {
        $hangul = new RomanizeHangul();

        //コ・ヨンピョ
        $this->assertSame($hangul->katakana('고영표', true), 'コ・ヨンピョ');

        //コ・ウソク
        $this->assertSame($hangul->katakana('고우석', true), 'コ・ウソク');
    }


    public function testPersonNameByForeign()
    {
        $hangul = new RomanizeHangul();

        //キンガム
        $this->assertSame($hangul->katakana('킹험', true), 'キン・ホム');
    }
}
