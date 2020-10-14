<?php

namespace WeblaborMX\ScrappingPlus\Drivers;

use WeblaborMX\ScrappingPlus\DriverFormat;
use voku\helper\HtmlDomParser;
use Illuminate\Support\Collection;

class Voku extends DriverFormat
{

    public $object;
    public $selector;

    public function setUrl($url) 
    {
        $opts = array(
            'http'=>array(
                'method' =>"GET",
                'header' =>"Accept-language: en\r\n" .
                    "User-Agent:    Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n".
                    "Cookie: foo=bar\r\n",
                'timeout' => 60
            )
        );
        $context = stream_context_create($opts);
        $html = @file_get_contents($url, false, $context);
        $this->setHtml($html);
        return $this;
    }

    public function setHtml($html) {
        $dom = HtmlDomParser::str_get_html($html);
        $this->object = $dom;
        return $this;
    }

    // Getters 

    public function get($selector) 
    {
        return collect($this->object->find($selector))->map(function($item) {
            $object = new Voku;
            $object->selector = $item;
            return $object->setHtml($item->outerHtml);
        });
    }

    // Attributes

    public function getHtml() 
    {
        return $this->object->outertext;
    }

    public function getAttribute($name) 
    {
        if(!isset($this->selector)) {
            return;
        }
        return $this->selector->$name;
    }

    public function getLink() 
    {
        return $this->getAttribute('href');
    }

    public function getText() 
    {
        return $this->selector->plaintext;
    }
    
}