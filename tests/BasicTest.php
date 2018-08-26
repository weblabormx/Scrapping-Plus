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

}
