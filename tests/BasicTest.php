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
}
