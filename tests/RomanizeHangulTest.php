<?php namespace Gayou\Romanize\Test;

use PHPUnit\Framework\TestCase;
use Gayou\Romanize\RomanizeHangul;

class RomanizeHangulTest extends TestCase
{
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


    public function testPersonNameByForeign()
    {
        $hangul = new RomanizeHangul();

        //キンガム
        $this->assertSame($hangul->katakana('킹험', true), 'キン・ホム');
    }
}
