<?php

namespace spec;

use PhpSpec\ObjectBehavior;

class SimpleXmlToJsonSerializerSpec extends ObjectBehavior
{
    // XML input samples
    private $inputXml = <<<STRING
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

    private $inputXmlWithAttributes = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist count="3">
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

    private $inputXmlWithOneElement = <<<STRING
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

    private $inputXmlWithOneElementWithAttributes = <<<STRING
<?xml version="1.0" encoding="UTF-8"?>
<result>
<status>ok</status>
<productlist count="1">
    <product>
        <id>1</id>
        <name>Prod1</name>
    </product>
</productlist>
</result>
STRING;

    public function it_is_initializable()
    {
        $this->shouldHaveType('SimpleXmlToJsonSerializer');
    }

    public function it_creates_SimpleXMLElement()
    {
        $this->beConstructedWith($this->inputXmlWithOneElement);
        $this->shouldBeAnInstanceOf('SimpleXMLElement');
    }

    public function it_converts_SimpleXML_object_to_array()
    {
        $this->beConstructedWith($this->inputXmlWithOneElement);
//        echo json_encode($this->getWrappedObject(), JSON_PRETTY_PRINT);
        var_dump(json_decode(json_encode($this->getWrappedObject()), true));
//        json_encode($this->getWrappedObject()->shouldBeAnInstanceOf('SimpleXMLElement');
//        $simpleXML = $this->createSimpleXML($this->inputXml);
//        $this->nativeJsonSerializer($simpleXML)->shouldBeArray();
    }

    public function it_should_have_some_specific_options_by_default()
    {
        $this->beConstructedWith($this->inputXmlWithOneElement);
        $this->getWrappedObject()->shouldHaveKey('username');
        $this->getWrappedObject()->shouldHaveValue('diegoholiveira');
    }

    public function getMatchers()
    {
        return [
            'haveKey' => function ($subject, $key) {
                return array_key_exists($key, $subject);
            },
            'haveValue' => function ($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }

/*
        function it_converts_productlist_to_array()
        {
            $simpleXML = $this->createSimpleXML($this->inputXmlWithOneElement);
            $this->nativeJsonSerializer($simpleXML)['productlist']['product']->shouldBeArray();
        }
    */
    /*
        function it_converts_product_to_array()
        {

            $simpleXML = new SimpleXmlToJsonSerializer($this->inputXmlWithOneElement);
            var_dump(json_encode($simpleXML));

    //        $this->myJsonSerializer($simpleXML)['productlist']['product']->shouldHaveKey(0);
        }

        function it_converts_product_to_array2()
        {
            $simpleXML = $this->createSimpleXML($this->inputXml);
            $this->nativeJsonSerializer($simpleXML)['productlist']['product']->shouldHaveKey(0);
        }
    */
}
