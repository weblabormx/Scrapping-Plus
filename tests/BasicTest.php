<?php

namespace WeblaborMX\ScrappingPlus\Tests;

use PHPUnit\Framework\TestCase;
use WeblaborMX\ScrappingPlus\Scrapping;

class BasicTest extends TestCase
{
    /** @test */
    public function parserTest()
    {
        $google = Scrapping::method('parser')->scrappe('https://www.google.com.mx');
        $html = $google->getHtml();

        // Access inputs
        $inputs = $google->get('input');
        $this->assertEquals(5, $inputs->count());

        $first = $inputs->first();
        $second = $inputs[1];

        $class = $google->first('input[name=btnI]');
        $title = $class->getAttribute('value');

        $this->assertEquals('Me siento con suerte ', $title);
    }

    /** @test */
    public function parserDusk()
    {
        $google = Scrapping::method('dusk')->scrappe('https://www.google.com.mx');
        $html = $google->getHtml();

        // convert on here to parser
        $google = $google->toParser();

        // Access inputs
        $inputs = $google->get('input');
        $this->assertEquals(9, $inputs->count());

        $first = $inputs->first();
        $second = $inputs[1];

        $class = $google->first('input[name=btnI]');
        $title = $class->getAttribute('value');

        $this->assertEquals('Me siento con suerte ', $title);
    }

    /** @test */
    public function useOriginalObject()
    {
        $page = Scrapping::method('dusk')->scrappe('https://www.ticketmaster.com.mx/Auditorio-Nacional-boletos-Mexico/venue/163841?tm_link=tm_homeA_b_10001_1');
        $page->object->waitForText('Ver Boletos');
        $page = $page->toParser();
        $item = $page->get('table#venue_results_tbl > tbody > tr');
        $items = $page->get('table#venue_results_tbl');

        $this->assertEquals(15, $item->count());

        $item = $item->first();
        $link = $item->first('a');
        var_dump($link->getLink());
    }

    /** @test */
    public function parserItsSelectedByDefault()
    {
        $google = Scrapping::scrappe('https://www.google.com.mx');
        $html = $google->getHtml();

        // Access inputs
        $inputs = $google->get('input');
        $this->assertEquals(5, $inputs->count());

        $first = $inputs->first();
        $second = $inputs[1];

        $class = $google->first('input[name=btnI]');
        $title = $class->getAttribute('value');

        $this->assertEquals('Me siento con suerte ', $title);
    }

    /** @test */
    public function vokuTest()
    {
        $google = Scrapping::method('voku')->scrappe('https://www.google.com.mx');
        $html = $google->getHtml();

        // Access inputs
        $inputs = $google->get('input');

        $first = $inputs->first();
        $second = $inputs[1];

        $class = $google->first('input[name=btnI]');
        $title = $class->getAttribute('value');

        $this->assertEquals('Me siento con suerte ', $title);
    }

    /** @test */
    public function bug1()
    {
        $page = Scrapping::method('voku')->scrappe('https://www.eticket.mx/masinformacion.aspx?idevento=23878');
        $image_header_url = $page->first('#copetes_dinamicos .ancholimitado img')->getAttribute('src');
        $image_poster_url = $page->first('.campo2_hor_izq .font14 img')->getAttribute('src');
        $image_map_url    = $page->first('#mapwrapper img')->getAttribute('src');
        $title            = $page->first('#copetes_dinamicos .ancholimitado img')->getAttribute('alt');
        $date             = $page->first('.grisclarofondo .mayusculas_primera')->getText();
        $hour             = $page->first('.grisclarofondo .mayusculas_primera > span')->getText();
        $hour             = str_replace('(', '', $hour);
        $hour             = str_replace(')', '', $hour);
        $address_object = $page->get('.grisclarofondo > div')[2];
        $address_object = $address_object->get('div > div');
        $place       = $address_object[0]->getText();
        $this->assertTrue(!is_null($place));
        $city        = $address_object[1]->getText();
        $this->assertTrue(!is_null($city));
        $address     = $address_object[2]->getText();
        $this->assertTrue(!is_null($address));
        $neighbor    = $address_object[3]->getText();
        $this->assertTrue(!is_null($neighbor));
        $postal_code = $address_object[4]->getText();
        $this->assertTrue(!is_null($postal_code));
    }

}
