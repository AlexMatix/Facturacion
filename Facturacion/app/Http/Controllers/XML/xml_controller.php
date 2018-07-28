<?php

namespace App\Http\Controllers\XML;

use App\Http\Controllers\apicontroller;
use SimpleXMLElement;

class xml_controller extends apicontroller
{
    function array2xml($array, $xml = false){

        if($xml === false){
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?> <cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" xmlns:cfdi="http://www.sat.gob.mx/cfd/3"> </cfdi:Comprobante>');
        }

        foreach($array as $key => $value){
            if(is_array($value)){
                $this->array2xml($value, $xml->addChild($key));
            } else {
                $xml->addAttribute($key, $value);
            }
        }

        return $xml->asXML();
    }
}
