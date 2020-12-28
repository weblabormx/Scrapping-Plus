<?php

namespace WeblaborMX\ScrappingPlus\Drivers;

use WeblaborMX\ScrappingPlus\DriverFormat;
use PHPHtmlParser\Dom;
use Illuminate\Support\Collection;
use PHPHtmlParser\Options;

class Parser extends DriverFormat
{

    public $object;
    public $selector;

    public function setUrl($url) 
    {
        $dom = $this->getDom();
        $dom->loadFromUrl($url);
        $this->object = $dom;
        return $this;
    }

    public function setHtml($html) {
        $dom = $this->getDom();
        $dom->loadStr($html);
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
        return $this->selector->text;
    }

    private function getDom()
    {
        $dom = new Dom;
        $dom->setOptions(
            // this is set as the global option level.
            (new Options())
                ->setCleanupInput(false) // Set a global option to enable strict html parsing.
        );
        return $dom;
    }
    
}