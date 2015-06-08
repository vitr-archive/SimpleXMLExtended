<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleXmlToJsonSerializerSpec extends ObjectBehavior
{
    // XML input samples
    private  $inputXml = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist>
    <product>
        <id>1</id>
        <name>Prod1</name>
    </product>
    <product>
        <id>2</id>
        <name>Prod1</name>
    </product>
    <product>
        <id>3</id>
        <name>Prod1</name>
    </product>
</productlist>
</result>
STRING;
    private  $inputXmlWithOneElement = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist>
    <product>
        <id>1</id>
        <name>Prod1</name>
    </product>
</productlist>
</result>
STRING;


    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleXmlToJsonSerializer');
    }

    function it_creates_SimpleXML_object()
    {
        $this->createSimpleXML($this->inputXml)->shouldReturnAnInstanceOf('SimpleXMLElement');
    }

    function it_converts_SimpleXML_object_to_array()
    {
        $simpleXML = $this->createSimpleXML($this->inputXml);
        $this->nativeJsonSerializer($simpleXML)->shouldBeArray();
    }

    function it_converts_productlist_to_array()
    {
        $simpleXML = $this->createSimpleXML($this->inputXmlWithOneElement);
        $this->nativeJsonSerializer($simpleXML)['productlist']['product']->shouldBeArray();
    }

    function it_converts_product_to_array()
    {
        $simpleXML = $this->createSimpleXML2($this->inputXmlWithOneElement);
        $this->myJsonSerializer($simpleXML)['productlist']['product']->shouldHaveKey(0);
    }

    function it_converts_product_to_array2()
    {
        $simpleXML = $this->createSimpleXML($this->inputXml);
        $this->nativeJsonSerializer($simpleXML)['productlist']['product']->shouldHaveKey(0);
    }


}
