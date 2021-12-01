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
        $this->assertEquals(10, $inputs->count());

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
        $this->assertEquals(8, $inputs->count());

        $first = $inputs->first();
        $second = $inputs[1];

        $class = $google->first('input[name=btnI]');
        $title = $class->getAttribute('value');

        $this->assertEquals('Me siento con suerte ', $title);
    }

    /** @test */
    public function parserItsSelectedByDefault()
    {
        $google = Scrapping::method('Voku')->scrappe('https://www.google.com.mx');

        // Access inputs
        $inputs = $google->get('input');
        $this->assertEquals(7, $inputs->count());

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
    public function fromHtml()
    {
        $scrapper = Scrapping::fromHtml('<html><body><h1>Hola</h1><p>Excerpt</p></body></html>');
        $h1 = $scrapper->first('h1');
        $this->assertEquals('Hola', $h1->getText());
    }
}
