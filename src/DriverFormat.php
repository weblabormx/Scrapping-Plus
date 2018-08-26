<?php

namespace WeblaborMX\ScrappingPlus;

abstract class DriverFormat
{
    abstract public function setUrl($url);
    abstract public function setHtml($html);
    abstract public function get($selector);
    abstract public function getAttribute($name);
    abstract public function getLink();
    abstract public function getText();

    public function first($selector) 
    {
        return $this->get($selector)->first();
    }

}