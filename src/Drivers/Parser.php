<?php

namespace WeblaborMX\ScrappingPlus\Drivers;

use WeblaborMX\ScrappingPlus\DriverFormat;
use PHPHtmlParser\Dom;
use Illuminate\Support\Collection;

class Parser extends DriverFormat
{

    public $object;
    public $selector;

    public function setUrl($url) 
    {
        $dom = new Dom;
        $dom->loadFromUrl($url);
        $this->object = $dom;
        return $this;
    }

    public function setHtml($html) {
        $dom = new Dom;
        $dom->loadStr($html, []);
        $this->object = $dom;
        return $this;
    }

    // Getters 

    public function get($selector) 
    {
        return collect($this->object->find($selector))->map(function($item) {
            $object = new Parser;
            $object->selector = $item;
            return $object->setHtml($item->outerHtml);
        });
    }


    // Attributes

    public function getHtml() 
    {
        return $this->object->outerHtml;
    }

    public function getAttribute($name) 
    {
        if(!isset($this->selector)) {
            return;
        }
        return $this->selector->getAttribute($name);
    }

    public function getLink() 
    {
        return $this->getAttribute('href');
    }

    public function getText() 
    {
        return $this->text;
    }
    
}