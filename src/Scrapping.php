<?php

namespace WeblaborMX\ScrappingPlus;

class Scrapping
{
    public static $method = 'Voku';

    static public function method($name) 
    {
        self::$method = $name;
        return new self;
    }

    static public function scrappe($url) 
    {
        $class = self::getClass();
        $object = new $class;
        return $object->setUrl($url);
    }

    static public function fromHtml($html) 
    {
        $class = self::getClass();
        $object = new $class;
        return $object->setHtml($html);
    }

    static private function getClass()
    {
        $class_name = ucwords(self::$method);
        $class_name = str_replace(' ', '', $class_name);
        $class = 'WeblaborMX\ScrappingPlus\Drivers\\'.$class_name;
        if(!class_exists($class)) {
            throw new \Exception("The method doesnt exist", 1);
        }
        return $class;
    }
}