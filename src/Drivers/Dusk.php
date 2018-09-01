<?php

namespace WeblaborMX\ScrappingPlus\Drivers;

use WeblaborMX\ScrappingPlus\DriverFormat;
use WeblaborMX\ScrappingPlus\DuskBrowser;

class Dusk extends DriverFormat
{

    public $browser;
    public $object;
    public $selector;

    public function __construct()
    {
        $this->browser = new DuskBrowser;
    }

    public function setUrl($url) {
        $this->browser->browse(function ($browpage) use ($url) {
            $browpage->visit($url);
            $this->object = $browpage;
        });
        return $this;
    }

    public function setHtml($html) {
        $object = new Voku;
        return $object->setHtml($html, []);
    }

    // Getters 

    public function get($selector) 
    {
        return;
    }

    public function toParser() {
        return $this->setHtml($this->getHtml());
    }

    // Attributes

    public function getHtml() 
    {
        return $this->object->driver->getPageSource();
    }

    public function getAttribute($name) 
    {
        return;
    }

    public function getLink() 
    {
        return;
    }

    public function getText() 
    {
        return;
    }
}