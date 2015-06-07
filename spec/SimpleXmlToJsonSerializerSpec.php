<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleXmlToJsonSerializerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SimpleXmlToJsonSerializer');
    }

    function it_creates_SimpleXML_object()
    {
        $this->createSimpleXML()->shouldReturnAnInstanceOf('SimpleXMLElement');
    }


    

}
