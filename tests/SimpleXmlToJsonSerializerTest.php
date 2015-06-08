<?php
class SimpleXmlToJsonSerializerTest extends PHPUnit_Framework_TestCase
{
    // XML input samples
    private static  $inputXml = <<<STRING
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
    private static  $inputXmlWithOneElement = <<<STRING
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

    /*
     * Shows default behaviour of json_encode for an object with multiple children of the same type
     * productlist->product[0], productlist->product[1], ...
     */
    public function testStandardJsonSerializerReturnsArrayOfProductsForMultipleProducts()
    {
        $SimpleXML = new SimpleXmlElement(self::$inputXml);
        $result = json_decode(json_encode($SimpleXML), true);
        $this->assertArrayHasKey(0, $result['productlist']['product']);
        $this->assertArrayNotHasKey('id', $result['productlist']['product']);
    }

    /*
     * Shows default behaviour of json_encode for an object with a single child
     * productlist->product->id
     */
    public function testStandardJsonSerializerDoesNotReturnArrayForSingleProduct()
    {
        $SimpleXML = new SimpleXmlElement(self::$inputXmlWithOneElement);
        $result = json_decode(json_encode($SimpleXML), true);
        $this->assertArrayNotHasKey(0, $result['productlist']['product']);
        $this->assertArrayHasKey('id', $result['productlist']['product']);
    }

    /*
     * Test the custom json_encode for an object with multiple children of the same type
     * productlist->product[0], productlist->product[1], ...
     */
    public function testProductIsArrayOfProductsForMultipleProducts()
    {
        $SimpleXMLfixed = new SimpleXmlToJsonSerializer(self::$inputXml);
        $result = json_decode(json_encode($SimpleXMLfixed), true);
        $this->assertArrayHasKey(0, $result['productlist']['product']);
        $this->assertArrayNotHasKey('id', $result['productlist']['product']);
    }

    /*
     * Test the custom json_encode for an object with a single child
     * productlist->product[0]->id
     *                       ^^^ this is expected behaviour
     * we want consistency across json_objects, despite the number of children
     */
    public function testProductIsArrayOfProductsForSingleProduct()
    {
        $SimpleXMLfixed = new SimpleXmlToJsonSerializer(self::$inputXmlWithOneElement);
        $result = json_decode(json_encode($SimpleXMLfixed), true);
        $this->assertArrayHasKey(0, $result['productlist']['product']);
        $this->assertArrayNotHasKey('id', $result['productlist']['product']);
    }
}
