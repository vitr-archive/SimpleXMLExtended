<?php

namespace App;

/*
 * Keeps the array structure for simpleXML nodes with only one child
 * during json encoding
 *
 * usage:
 *
 * $mySimpleXML = new SimpleXMLExtended($xmlString);
 * json_encode($mySimpleXML);
 *
 */
class SimpleXMLExtended extends \SimpleXMLElement implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $value = (array) $this;
        ///// fix for @attributes
        $next = next($value);
        if (isset($value['@attributes']) && gettype($next) == 'object') {
            $value[key($value)] = [$value[key($value)]];
        }
        reset($value);
        /////////
        if (count($value) == 1 and gettype(reset($value)) != 'array') {
            return [key($value) => [(array) reset($value)]];
        }

        return $value;
    }

    /*
     * Example Usage
     $xmlFile    = 'config.xml';
     // instead of $xml = new SimpleXMLElement('<site/>');
     $xml        = new SimpleXMLExtended('<site/>');
     $xml->title = NULL; // VERY IMPORTANT! We need a node where to append
     $xml->title->addCData('Site Title');
     $xml->title->addAttribute('lang', 'en');
     $xml->saveXML($xmlFile);
     */

    public function addCData($cdata_text)
    {
        $node = dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
    }
}
