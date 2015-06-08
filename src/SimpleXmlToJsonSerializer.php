<?php

class SimpleXmlToJsonSerializer
{
    public function createSimpleXML($xml_string)
    {
        return new SimpleXMLElement($xml_string);
    }

    public function createSimpleXML2($xml_string)
    {
        return new XML2JsonSearchResult($xml_string);
    }

    public function nativeJsonSerializer(SimpleXMLElement $SimpleXML)
    {
//        var_dump(json_decode(json_encode($SimpleXML), true)['productlist']);
        return json_decode(json_encode($SimpleXML), true);
    }

    public function myJsonSerializer(XML2JsonSearchResult $SimpleXML)
    {
//        var_dump(json_decode(json_encode($SimpleXML), true)['productlist']);
        return json_decode(json_encode($SimpleXML), true);
    }
}
